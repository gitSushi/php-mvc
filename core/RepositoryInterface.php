<?php

interface RepositoryInterface
{
    public function getAll();
    public function getAllBy($array);
}