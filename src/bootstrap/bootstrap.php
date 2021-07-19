<?php

use core\Request;
use core\Session;


$config = include(__DIR__ . "/../application/config.php");

$includeFiles = services\Autoloader::getInstance();

$includeFiles->register();

services\PostgresDataBase::getInstance($config['database']);

$session = Session::getInstance($_SESSION);

$request = Request::getInstance();

$app = (core\Route::getInstance(['request' => $request, 'session' => $session]));

$app->run();




