<?php

namespace core;

abstract class Controller
{

    protected $view;

    public function __construct()
    {
        $this->view = new View();
        $this->view->page = self::class;
    }
}