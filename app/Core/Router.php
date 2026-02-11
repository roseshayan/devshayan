<?php

declare(strict_types=1);

namespace App\Core;

final class Router
{
    private array $routes = ['GET' => [], 'POST' => []];
    private Request $request;
    public function __construct()
    {
        $this->request = new Request();
    }
    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }
    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }
    public function dispatch(): void
    {
        $method = $this->request->method();
        $path = $this->request->path();
        $handler = $this->routes[$method][$path] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo '404 | Not Found';
            return;
        }
        [$class, $action] = $handler;
        $controller = new $class();
        echo $controller->$action();
    }
}
