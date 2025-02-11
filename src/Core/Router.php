<?php

namespace Src\Core;

use Src\Core\Request;

class Router
{
    protected $routes = [];

    public function addRoute($method, $uri, $action, $name = null)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'name' => $name,
        ];
    }

    public function dispatch(Request $request)
    {
        $uri = $request->getUri();
        $method = $request->getMethod();

        foreach ($this->routes as $route) {
            if ($route['method'] === $method && $route['uri'] === $uri) {
                $controller = $route['action'][0];
                $method = $route['action'][1];

                call_user_func_array([new $controller, $method], [$request]);
                return;
            }
        }

        echo "Route not defined!";
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}