<?php

$config = include(__DIR__ . "/config.php");

$includeFiles = services\Autoloader::includeFiles($config['application']);

$includeFiles->register();

services\DataBase::getInstance($config['database']);

$app = (core\Route::start());

$app->run();



