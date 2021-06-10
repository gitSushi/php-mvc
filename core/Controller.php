<?php

abstract class Controller
{
    /**
     * Déclaration des variables privées (seulement accessible par les méthodes) get et post
     */
    private $get, $post;

    /**
     * affectation de super globales $_GET et $_POST aux propriétés get et post
     */
    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    /**
     * la fonction render
     * @param string $pathToView
     * @param array $data
     */
    protected function render(string $pathToView, array $datas)
    {
        foreach ($datas as $key => $value) {
            $$key = $value;
        }
        include('./views/' . $pathToView . '.php');
    }

    /**
     * final empêche la réécriture
     * retourne la propriété get contenant la super globale $_GET
     */
    protected final function inputGet()
    {
        return $this->get;
    }

    /**
     * final empêche la réécriture
     * retourne la propriété post contenant la super globale $_POST
     */
    protected final function inputPost()
    {
        return $this->post;
    }
}