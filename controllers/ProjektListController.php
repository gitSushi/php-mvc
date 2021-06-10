<?php

class ProjektListController extends Controller
{

    public function getAll()
    {
        $this->render("index", ["projects" => (new DAOProjects())->getAll()]);
    }
}