<?php

class DAOUser extends DAO
{
    public function getAll()
    {
        echo "All the people";
    }

    public function getAllBy($associativeArray)
    {
    }

    /**
     * @param array $args
     */
    public function retrieve($args)
    {
        var_dump($args);
        echo "Is " . $args[0] . " your age ?";
        echo "<br/>";
        echo "length of args is: " . count($args);
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