<?php

require_once './vendor/autoload.php';
// Include router class
require_once 'Route.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Example of usage https://steampixel.de/simple-and-elegant-url-routing-with-php/
Route::add('/([a-z]*)/([a-z]*)', function($param1, $param2) {
    $className = ucfirst(strtolower($param1));

    require_once './Controller/' . $className . '/' . $className . '.php';

    $obj = new $className();

    $command = strtolower($param2);
    $obj->$command();

    echo 'done';
});

// Run basepath
Route::run('/');
