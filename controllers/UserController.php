<?php

class UserController extends Controller
{

    public function getHome()
    {
        $this->render("index", ["blabla" => "some text", "boo" => "A ghost is talking to you !"]);
    }
}