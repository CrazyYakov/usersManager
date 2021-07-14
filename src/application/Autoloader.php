<?php

namespace services;

class Autoloader
{
    protected array $files;

    protected static Autoloader $loadedFiles;

    protected $app = 'application';

    protected function __construct(array $config = [])
    {
        $this->files = Autoloader::recurseDirectories($config);

    }

    public static function includeFiles(array $config = []): Autoloader
    {
        if (!empty(self::$loadedFiles)) {
            array_push(self::$loadedFiles->files, $config);
            return self::$loadedFiles;
        }
        self::$loadedFiles = new self($config);
        return self::$loadedFiles;
    }

    public function register()
    {
        spl_autoload_register(array($this, 'autoload'));
    }

    private function autoload($class)
    {
        $fileClass = preg_replace("/\\\/", '/', "{$class}.php");
        if (in_array($fileClass, $this->files) && file_exists(__DIR__ . "/" . $fileClass)) {
            include(__DIR__ . "/" . $fileClass);
            return true;

        }
        return false;
    }

    private static function recurseDirectories($arrayFiles, $path = null): array
    {
        $files = [];
        foreach ($arrayFiles as $dir => $file) {

            if (!is_array($file)) {
                array_push($files, "{$path}{$file}.php");
            } else {
                $dirWithFiles = self::recurseDirectories($file, $path . $dir . "/");
                $files = array_merge($files, $dirWithFiles);
            }
        }
        return $files;
    }
}