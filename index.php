<?php

// Include router class
require_once ('Route.php');

// Example of usage https://steampixel.de/simple-and-elegant-url-routing-with-php/
Route::add('/([a-z]*)/([a-z]*)', function($param1, $param2) {
    $class = ucfirst(strtolower($param1));

    require_once($class . '.php');
    $obj = new $class();

    $command = strtolower($param2);
    $obj->$command();

    echo 'done';
});

// Run basepath
Route::run('/');