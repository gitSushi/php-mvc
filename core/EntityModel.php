<?php

include_once('core/Persistable.php');
include_once('core/CRUDInterface.php');
include_once('core/DAO.php');

/**
 * Agrémenter un modèle plus souple,
 * moins lourd, et plus transparent.
 */
abstract class EntityModel implements Persistable
{
    protected CRUDInterface $dao;

    /**
     * Automatisation la création du dao en implémentant vous même
     * l’instanciation du dao dans le constructeur d’EntityModel
     */
    public function __construct()
    {
        $this->dao = new DAO();
    }


    public function load($id)
    {
        $this->dao->retrieve($id);
    }

    public function update($arg)
    {
        if (gettype($arg) === "array") {
            $this->dao->create($arg);
        } else {
            $this->dao->update($arg);
        }
    }

    public function remove($id)
    {
        $this->dao->delete($id);
    }
}