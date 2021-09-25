<?php

//ini_set('display_errors', true);
//error_reporting(E_ALL);

// Include router class
require_once ('Route.php');

// Example of usage https://steampixel.de/simple-and-elegant-url-routing-with-php/
// Accept only numbers as parameter. Other characters will result in a 404 error
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