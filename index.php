<?php

require_once './vendor/autoload.php';

// Include router class
require_once 'Route.php';

use Dotenv\Dotenv;

spl_autoload_register(static function($className) {
    $file = __DIR__ . '\\Controller\\' . $className . '.php';
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    if (!file_exists($file)) {
        $file = __DIR__ . '\\Controller\\' . $className . '\\' . $className . '.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
    }

    if (file_exists($file)) {
        require_once($file);
    }
});

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Example of route usage https://steampixel.de/simple-and-elegant-url-routing-with-php/
Route::add('/([a-z]*)/([a-z]*)', function($param1, $param2) {

    try {
        $className = ucfirst(strtolower($param1));

        $obj = new $className();
        $command = strtolower($param2);
        $obj->$command();

        echo 'done';

    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }

});

// Run basepath
Route::run('/');
