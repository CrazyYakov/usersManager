<?php

use core\Request;

$config = include(__DIR__ . "/../application/config.php");

$includeFiles = services\Autoloader::includeFiles($config['application']);

$includeFiles->register();

services\PostgresDataBase::getInstance($config['database']);

$request = Request::initialization();

$app = (core\Route::start($request));


$redis = new Redis();
$redis->connect('redis',6379);

var_dump($redis);
//exit();

$app->run();




