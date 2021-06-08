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
        echo "Is " . $args[0] . " your age ?";
    }
}