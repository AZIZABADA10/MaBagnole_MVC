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

            if (!class_exists($controllerName)) {
                die("Controller introuvable : " . $controllerName);
            }

            $controller = new $controllerName();

            if (!method_exists($controller, $action)) {
                die("Méthode introuvable : " . $action);
            }

            $controller->$action();

        } else {

            echo "Page non trouvée";
        }
    }


}