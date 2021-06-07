<?php

interface CRUDInterface
{
    /**
     * @param int $id : prend en argument l’id de l’entité à manipuler
     * @return object  retourne une entité
     */
    public function retrieve($id);

    /**
     * @param int $id : prend en argument l’id de l’entité à manipuler
     * @return bool un booléen de la réussite du traitement
     */
    public function update($id);

    /**
     * @param int $id : prend en argument l’id de l’entité à manipuler
     * @return bool un booléen de la réussite du traitement 
     */
    public function delete($id);

    /**
     * @param int $associativeArray : prend en argument un tableau associatif des propriétés
     * @return object  retourne une entité
     */
    public function create($associativeArray);
}