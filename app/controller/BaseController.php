<?php

abstract class BaseController
{

    protected $data = [];

    public function __construct()
    {
        $this->initialize();
    }

    protected abstract function initialize();

    public function getData(){
        return $this->data;
    }
}
