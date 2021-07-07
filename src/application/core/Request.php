<?php


namespace core;


class Request
{

    public static function handlerRequest()
    {
        var_dump($_POST);
        var_dump($_GET);
    }
    
    
}