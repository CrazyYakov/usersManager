<?php

namespace services;

class Autoloader
{
    protected static Autoloader $loadedFiles;

    public static function getInstance(): Autoloader
    {
        return self::$loadedFiles = new self;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    private function autoload($class)
    {  //смотри в config.php если файл не найден
        try {
            $fileClass = preg_replace("/\\\/", '/', "{$class}.php");
            if (file_exists(__DIR__ . "/" . $fileClass)) {
                include(__DIR__ . "/" . $fileClass);
            } else {
                throw new \Exception("not found");
            }
        } catch (\Exception $e) {
            echo "File" . __DIR__ . "/$fileClass {$e->getMessage()}";
            die();
        }
    }
}