<?php

class DAOProjects extends DAO
{
    public function getAll()
    {
        return $this->pdo->query(
            "SELECT project_id, project_name, description, logo, start_date, end_date
            FROM PROJECT"
        )
            ->fetchAll(PDO::FETCH_ASSOC);;
    }

    public function getAllBy($associativeArray)
    {
    }

    /**
     * @param array $args
     */
    public function retrieve($args)
    {
    }

    public function create($associativeArray)
    {
    }

    public function update($id)
    {
    }

    public function delete($id)
    {
    }
}