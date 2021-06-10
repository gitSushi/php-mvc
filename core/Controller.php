<?php

abstract class Controller
{
    private $get, $post;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
    }

    public function render($pathToView, $data)
    {
    }
}