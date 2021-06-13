<?php

class ProjektListController extends Controller
{

    public function getAll()
    {
        $this->render("index", ["projects" => (new DAOProjects())->getAll()]);
    }

    public function getOrdered()
    {
        $order = strtoupper($this->inputGet()["order"]);
        $limit = $this->inputGet()["limit"];
        $this->render("index", ["projects" => (new DAOProjects())->getSome($order, $limit)]);
    }

    public function jsonfdsfsdf()
    {
        $this->jsonRender("main", array("name" => "bob", "notname" => "notBob"));
    }
}