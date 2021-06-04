<?php

abstract class BaseController
{

    protected $data = [];
    
    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->initialize();
    }
    
    /**
     * initialize
     *
     * @return void
     */
    protected abstract function initialize();

    public function getData(){
        return $this->data;
    }
}
