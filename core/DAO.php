<?php

include_once('core/RepositoryInterface.php');
include_once('core/CRUDInterface.php');

abstract class DAO implements RepositoryInterface, CRUDInterface
{
    protected $pdo;

    public function __construct()
    {
        $config = json_decode(file_get_contents("config/database.json"));
        $dsn = "mysql:host=$config->host;dbname=$config->dbname;charset=utf8;port=$config->port";
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $this->pdo = new \PDO($dsn, $config->username, $config->password, $options);
    }
}