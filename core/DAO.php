<?php

include_once('core/RepositoryInterface.php');
include_once('core/CRUDInterface.php');

abstract class DAO implements RepositoryInterface, CRUDInterface
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new \PDO("dsn");
    }


    public function retrieve($id)
    {
        return $this;
    }

    public function update($id)
    {
        return;
    }

    public function delete($id)
    {
        return;
    }

    public function create($associativeArray)
    {
        return $this;
    }


    public function getAll()
    {
        return $this;
    }

    public function getAllBy($associativeArray)
    {
    }
}