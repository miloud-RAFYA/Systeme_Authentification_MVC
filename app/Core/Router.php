<?php

namespace App\Core;

class Router
{
    public function run()
    {
        $controller = $_GET['controller'] ?? 'auth';
        $action = $_GET['action'] ?? 'login';

        $controllerClass = 'App\\Controller\\' . ucfirst($controller) . 'Controller';
        //  var_dump($controllerClass);
        //  exit;
        if (!class_exists($controllerClass)) {
            die('Controller not found');
        }

        $controllerObject = new $controllerClass();

        if (!method_exists($controllerObject, $action)) {
            die('Action not found');
        }

        $controllerObject->$action();
    }
}
