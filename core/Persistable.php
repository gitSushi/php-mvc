<?php

interface Persistable
{
    /**
     * invoque la méthode retrieve sur le dao en passant en argument l’id de l’entité courante
     * 
     * @param int $id : l’id de l’entité courante
     */
    public function load($id);

    /**
     * invoque la méthode create() sur le dao si l’entité courante n’as pas d’id et
     * update dans le cas contraire. (la propriété $dao est de type CRUDInterface)
     *  
     * @param array|int $arg : create -> prend en argument un tableau associatif des propriétés
     *                  OU update -> prend en argument l’id de l’entité à manipuler
     */
    public function update($arg);

    /**
     * invoque la méthode delete() du dao (la propriété $dao est de type CRUDInterface).
     * 
     * @param int $id : l’id de l’entité courante
     */
    public function remove($id);
}