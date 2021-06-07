<?php

interface RepositoryInterface
{
    /**
     * @return array les données
     */
    public function getAll();

    /**
     * @param array $associativeArray : prend en argument un tableau associatif
     *              pour les clauses WHERE et AND des requêtes SQL
     * @return array les données
     */
    public function getAllBy($associativeArray);
}