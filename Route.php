<?php

class Route {

    private static array $routes = [];
    private static $pathNotFound = null;
    private static $methodNotAllowed = null;

    public static function add(string $expression, callable $function, string $method = 'get'): void
    {
        self::$routes[] = array(
            'expression' => $expression,
            'function' => $function,
            'method' => $method
        );
    }

    public static function pathNotFound(callable $function): void
    {
        self::$pathNotFound = $function;
    }

    public static function methodNotAllowed(callable $function): void
    {
        self::$methodNotAllowed = $function;
    }

    public static function run(string $basepath = '/'): void
    {

        // Parse current url
        $parsed_url = parse_url($_SERVER['REQUEST_URI']);//Parse Uri

        $path = $parsed_url['path'] ?? '/';

        // Get current request method
        $method = $_SERVER['REQUEST_METHOD'];

        $path_match_found = false;
        $route_match_found = false;

        foreach(self::$routes as $route){

            // If the method matches check the path

            // Add basepath to matching string
            if ($basepath!=='' && $basepath!=='/'){
                $route['expression'] = '('.$basepath.')'.$route['expression'];
            }

            // Add 'find string start' automatically
            $route['expression'] = '^'.$route['expression'];

            // Add 'find string end' automatically
            $route['expression'] .= '$';

            // Check path match
            if (preg_match('#'.$route['expression'].'#',$path,$matches)) {

                $path_match_found = true;

                // Check method match
                if (strtolower($method) === strtolower($route['method'])) {

                    array_shift($matches);// Always remove first element. This contains the whole string

                    if ($basepath!=='' && $basepath!=='/') {
                        array_shift($matches);// Remove basepath
                    }

                    call_user_func_array($route['function'], $matches);

                    $route_match_found = true;

                    // Do not check other routes
                    break;
                }
            }
        }

        // No matching route was found
        if (!$route_match_found) {

            // But a matching path exists
            if ($path_match_found) {
                header("HTTP/1.0 405 Method Not Allowed");
                if (self::$methodNotAllowed) {
                    call_user_func(self::$methodNotAllowed, $path, $method);
                }
            } else {
                header("HTTP/1.0 404 Not Found");
                if (self::$pathNotFound) {
                    call_user_func(self::$pathNotFound, $path);
                }
            }

        }

    }

}
