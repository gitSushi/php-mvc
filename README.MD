# Mon propre Framework MVC

Dans le cadre d'un TD sur la POO (Programmation Orientée Objet) pendant ma formation [Beweb](https://fondespierre.com/nos-poles-de-competences/beweb-ecole-numerique/developpeur-web/), j'ai codé un framework PHP de type MVC (Model-View-Controller).

## Utilisation

### Routing

Dans le fichier config/routing.json, rentrez vos `"route": "controleur:méthode"` paires.
- soit la route pointant directement au controleur:méthode
    :warning: N'OUBLIEZ PAS LES DEUX-POINTS ENTRE LE CONTROLEUR ET LA METHODE :warning:
    ```json
    {
        "/": "ViewController:getHome"
    }
    ```
- soit un objet avec des paires `"Verbe_HTTP": "controleur:méthode"`
    ```json
    {
        "/api/users": {
            "GET": "DAOUser:getAll",
            "DELETE": "DAOUser:deleteAll"
        }
    }
    ```
- soit une route avec des variables représenté ici par `(:)` :warning: SI VOUS VOULEZ CHANGER LE SYMBOLE IL VOUS FAUDRA LE CHANGER EGALEMENT DANS LE FICHIER core/Routing.php :warning:
    ```json
    {
        "/api/users/(:)": {
            "GET": "DAOUser:retrieve",
            "PUT": "DAOUser:update"
        },
    }
    ```

### Contrôleur

Vos classes contrôleur dans le dossier /controllers doivent `extends Controller`.
La méthode intégrée `render` vous permet de renvoyer vos données à la vue sous la forme d'un tableau associatif.
```php
$this->render("index", ["greeting" => "Hello World !"]);
```
ou bien si vous avez déjà implémenté le dao vous pouvez récupérer les datas dans votre base de données comme suit :
```php
$this->render("index", ["users" => (new DAOUser())->getAll()]);
```

### DAO

Vos classes dao dans le dossier /dao doivent `extends DAO`.
De plus il faut donner un corps à toutes les fonctions provenant des interfaces RepositoryInterface et CRUDInterface. A savoir :
    - `public function getAll();`
    - `public function getAllBy($associativeArray);`

    - `public function create($associativeArray);`
    - `public function retrieve($id);`
    - `public function update($id);`
    - `public function delete($id);`

Vous pourrez y ajouter vos query SQL et alimenter vos modèles. Vous avez bien évidemment accès à votre pdo si vous avez correctement rempli votre fichier database.json.
```php
public function getAll()
{
    return $this->pdo->query(
        "SELECT project_id, project_name, description, logo, start_date, end_date
        FROM PROJECT"
        )
        ->fetchAll(PDO::FETCH_ASSOC);
}

```

### Le fichier database.json

Il y quatre champs requis. Le host (127.0.0.1, 172.17.0.1, ...), dbname (le nom que vous avez choisi pour votre base de données), username et password (si vous l'avez rempli sinon à laisser blanc). Le port par défault de MySQL (3306) sera utilisé si laissé blanc.
```json
{
  "driver": "",
  "host": "",
  "port": "",
  "dbname": "",
  "username": "",
  "password": ""
}
```

### Views

Dans un fichier PHP que vous avez nommé dans le contrôleur, vous pouvez y mettre votre contenu HTML et accéder à vos données passées en deuxième argument.
```php
<p><?= $greeting ?></p>
```
```output
Hello World !
```

Useless test : /play trololo