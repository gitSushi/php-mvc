<?php

abstract class DAO implements RepositoryInterface, CRUDInterface
{
    protected $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('dsn');
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
    }

    public function getAllBy($associativeArray)
    {
    }
}