<?php

interface CRUDInterface
{
    public function retrieve();
    public function update();
    public function delete();
    public function create();
}