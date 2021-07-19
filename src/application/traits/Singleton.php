<?php


namespace traits;


trait Singleton
{
    public static $instance;

    public static function getInstance(...$params)
    {
        if (!empty(self::$instance)) {
            return self::$instance;
        }
        return self::$instance = new self($params);
    }
}