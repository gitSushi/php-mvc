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

    /**
     * array : $args
     * les arguments sont les variables de $_SERVER["REQUEST_URI"]
     * représenté dans le fichier routing.json par (:)
     */

    /**
     * string : $method
     * la méthode ou verbe http (GET, POST, ...) provenant de $_SERVER["REQUEST_METHOD"]
     * devra être comparé à la clé du tableau associatif imbriqué
     * dans une des clé du tableau associatif de la propriété $this->config
     *  exemple : "GET": "DAOUser:retrieve",
     */


    public function __construct()
    {
        $this->config = json_decode(file_get_contents("config/routing.json"), true);
        // $this->uri = [];
        // $this->route = [];
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
        // for ($i = 0; $i < count($this->config); $i++) {
        //     if ($this->isEqual()) {
        //         $this->compare();
        //     }
        // }

        $this->uri = explode("/", $_SERVER["REQUEST_URI"]);
        array_shift($this->uri);

        $this->route = ["bob", "toto"];


        return $this->isEqual();
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
     * @return 
     */


    /**
     * addArgument()
     * ajoute à $args les variables (:)
     *  exemple : /api/users/52/messages/32
     *           ajoute 52 à $args puis ajoutera 32 à son prochain appel
     */


    /**
     * compare()
     * compare chaque élément des deux tableaux ($uri et $route)
     * si les deux tableaux sont égaux, la route est trouvée
     *  exemple : 
     *   - $_SERVER["REQUEST_URI"] = "/api/users/52"
     *   - $_SERVER["REQUEST_METHOD"] = "POST"
     *  est égale à
     *   - "/api/users/(:)"
     *   - "POST": "DAOUser:create"
     */
    private function compare()
    {
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
}