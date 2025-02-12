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
            if ($route['method'] === $method) {
                $pattern = preg_replace('/\{([^\/]+)\}/', '(?P<\1>[^\/]+)', $route['uri']);
                $pattern = "@^" . $pattern . "$@D";
    
                if (preg_match($pattern, $uri, $matches)) {
                    $controller = $route['action'][0];
                    $action = $route['action'][1];
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    if (empty($params)) {
                        $params = [$request];
                    }
                    call_user_func_array([new $controller, $action], array_values($params));
                    return;
                } 
            }
        }
    
        echo "Route not defined!";
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}