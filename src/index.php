<?php

ini_set('session.save_handler', 'redis');
ini_set('session.save_path', 'redis:6379');

/**
 * Include Autoloader
 */

require "application/Autoloader.php";


/**
 * Getting started
 */
require "bootstrap/bootstrap.php";

