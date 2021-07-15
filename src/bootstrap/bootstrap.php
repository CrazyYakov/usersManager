<?php

use core\Request;
use services\Session;


$config = include(__DIR__ . "/../application/config.php");

$includeFiles = services\Autoloader::includeFiles($config['application']);

$includeFiles->register();

services\PostgresDataBase::getInstance($config['database']);

$session = Session::initialization($_SESSION);

$request = Request::initialization();

$app = (core\Route::getRoute($request, $session));

$app->run();




