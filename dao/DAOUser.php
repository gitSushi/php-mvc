<?php

class DAOUser
{
    public function getAll()
    {
        echo "All or nothing !";
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
}