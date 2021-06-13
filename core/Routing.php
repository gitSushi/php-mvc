<?php

class Routing
{
    /**
     * tableau associatif : mapping de routing.json
     */
    private $config;

    /**
     * array : $uri
     * Découpage de $_SERVER["REQUEST_URI"] mis dans un tableau $uri
     * explode()
     */
    private $uri;

    /**
     * array : $route
     * les clés du tableau associatif $this->config sont de même découpé
     * et mis dans un tableau $route
     * explode()
     */
    private $route;

    /**
     * string : $controller
     * controlleur trouvé depuis le $this->config au niveau des valeurs
     *  exemple : "ViewController:getHome", -> controlleur:méthode
     */
    private $controller;

    /**
     * array : $args
     * les arguments sont les variables de $_SERVER["REQUEST_URI"]
     * représenté dans le fichier routing.json par (:)
     */
    private $args;

    /**
     * string : $method
     * la méthode ou verbe http (GET, POST, ...) provenant de $_SERVER["REQUEST_METHOD"]
     * devra être comparé à la clé du tableau associatif imbriqué
     * dans une des clé du tableau associatif de la propriété $this->config
     *  exemple : "GET": "DAOUser:retrieve",
     */
    private $method;


    public function __construct()
    {
        $this->config = json_decode(file_get_contents("config/routing.json"), true);
        $this->uri = explode("/", $_SERVER["REQUEST_URI"]);
        $lastEl = count($this->uri) - 1;
        $lastSplit = explode("?", $this->uri[$lastEl]);
        if (count($lastSplit) > 1) {
            $this->uri[$lastEl] = explode("?", $this->uri[$lastEl])[0] . "?";
        }
        $this->route = array();
        $this->method = $_SERVER["REQUEST_METHOD"];
    }

    /**
     * execute()
     * C'est le lancement du routing
     * La boucle qui cherche une route valide parmis les possibilités
     * provenant de la propriété $this->config
     * sinon 404
     * 
     * Dans une boucle exterieure (nombre de boucle === count($this->config))
     * dans notre cas c'est 4.
     *      si isEqual() retourne vraic c'est que count($uri) === count($route)
     *      la boucle intérieure est alors lancé, c'est l'appel de compare()
     *          addArgument() est appellé si la comparaison retourne faux
     *          et une variable est ajouté à $args
     *      getValue() est appellé à la fin de la boucle intérieure
     * Enfin si une route a été trouvé, appel de invoke() ou 404
     */
    public function execute()
    {
        // cleaning $this->uri of extra "" left from explode()
        $this->sanitize($this->uri);
        if ($this->uri[count($this->uri) - 1] === "" && count($this->uri) > 1) {
            array_pop($this->uri);
        }


        foreach (array_keys($this->config) as $key) {
            /**
             * Reinitialise args pour les cas de path à variable(s)
             *  Exemple :
             *      - route -> /boo/loo/(:)/dao/(:) puis /boo/loo/(:)/tao/(:)
             *      - uri -> /boo/loo/45/tao/78
             *  Sans la réinitialisation la longueur de $args serait 3
             *  alors qu'il n'y a que 2 variables qui nous intéresse.
             */
            $this->args = array();

            $this->route = explode("/", $key);
            $this->sanitize($this->route);

            if ($this->isEqual()) {
                $this->compare();
            }
        }
    }


    /**
     * isEqual()
     * retourne vrai si la longueur des tableaux ($uri et $route) est identique
     *  exemple : count($uri) === count($route)
     * @return bool
     */
    private function isEqual()
    {
        return count($this->uri) === count($this->route);
    }


    /**
     * getValue()
     * deux cas peuvent se présenter
     *      - retourne le controlleur provenant de la valeur dans la propriété $this->config
     *          exemple : "ViewController:getCartes",
     *                     return ViewController;
     *      - boucle dans le tableau suivant et compare le verbe passé par $_SERVER["REQUEST_METHOD"]
     *        avec la clé puis retourne si vrai
     *          exemple : "PUT": "DAOUser:update",
     *                     return DAOUser;
     * @param string|array $value
     * @return string la chaine correspondant au contrôleur
     */
    private function getValue($value)
    {
        if (gettype($value) === "array") {
            return $value[$this->method];
        }
        return $value;
    }


    /**
     * addArgument()
     * ajoute à $args les variables (:)
     *  Exemple : /api/users/52/messages/32
     *           ajoute 52 à $args puis ajoutera 32 à son prochain appel
     * @param int|string should be index of a table's row
     * @return bool
     */
    private function addArgument($index)
    {
        if ($this->route[$index] === "(:)") {
            array_push($this->args, $this->uri[$index]);
            return true;
        }
        return false;
    }


    /**
     * compare()
     * compare chaque élément des deux tableaux ($uri et $route)
     * si les deux tableaux sont égaux, la route est trouvée.
     *  Exemple : 
     *   - $_SERVER["REQUEST_URI"] = "/api/users/52"
     *   - $_SERVER["REQUEST_METHOD"] = "POST"
     *  est égale à
     *   - "/api/users/(:)"
     *   - "POST": "DAOUser:create"
     * @return bool
     */
    private function compare()
    {
        foreach (array_keys($this->uri) as $index) {
            if ($this->uri[$index] !== $this->route[$index]) {
                if (!$this->addArgument($index)) return false;
            }
        }

        $this->controller = $this->getValue($this->config["/" . implode("/", $this->route)]);
        $this->invoke();
    }


    /**
     * invoke()
     * si une route est trouvé la méthode invoke est appellée
     * Le controlleur de $controller est instancié
     * la méthode correspondante est appellée avec les arguments de $args
     *  exemple : DAOUser:create -> controlleur:méthode
     *  $daoUser = new DAOUser();
     *  $daoUser->create($args);
     */
    private function invoke()
    {
        $split = explode(":", $this->controller);

        $controllerClass = $split[0];
        $controllerMethod = $split[1];

        // $controllerObject = new $controllerClass();
        // if (count($this->args) > 0) $controllerObject->$controllerMethod($this->args);
        // else $controllerObject->$controllerMethod();

        // Does the same thing as above
        call_user_func_array(array(new $controllerClass, $controllerMethod), array($this->args));
    }

    /**
     *  nettoie les listes $uri et $route en enlevant les éléments qui sont une chaine vide.
     * @param array $array la liste à nettoyer
     */
    private function sanitize(&$array)
    {
        array_shift($array);
    }
}