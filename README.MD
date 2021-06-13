# Mon propre Framework MVC

## Utilisation

### Routing

Dans le fichier config/routing.json, rentrez vos `"routes": "controller:méthode"` paires.
- soit la route pointant directement au controleur:méthode
    :warning: DO NOT FORGET THE COLON IN BETWEEN :warning:
    ```json
    {
        "/": "ViewController:getHome"
    }
    ```
- soit directement
    ```json
    {
        "/api/users": {
            "GET": "DAOUser:getAll",
            "DELETE": "DAOUser:deleteAll"
        },
        "/api/users/(:)": {
            "GET": "DAOUser:getAll",
            "DELETE": "DAOUser:deleteAll"
        },
    }
    ```
- soit directement
    ```json
    {
        "/": "ViewController:getHome",
        "/api/users": {
            "GET": "DAOUser:getAll",
            "DELETE": "DAOUser:deleteAll"
        },
        "/api/users/(:)": {
            "GET": "DAOUser:getAll",
            "DELETE": "DAOUser:deleteAll"
        },
    }
    ```

