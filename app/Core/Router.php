<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function add($url, $controller, $action)
    {
        $this->routes[$url] = ['controller'=>$controller,'action'=>$action];
    }
    public function run($url)
    {
        if (isset($this->routes[$url])) {
            $controllerName = $this->routes[$url]['controller'];
            $action = $this->routes[$url]['action'];

            $controller = new $controllerName();
            $controller->$action();
        } else {
            http_response_code(404);
            echo "404 - Page non trouvée";
        }
    }

}