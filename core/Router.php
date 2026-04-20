<?php

declare(strict_types=1);

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public function get(string $path, array $handler, array $middlewares = []): void
    {
        $this->routes['GET'][$path] = compact('handler', 'middlewares');
    }

    public function post(string $path, array $handler, array $middlewares = []): void
    {
        $this->routes['POST'][$path] = compact('handler', 'middlewares');
    }

    public function dispatch(string $method, string $path): void
    {
        $route = $this->routes[$method][$path] ?? null;

        if (!$route) {
            http_response_code(404);
            echo 'Ruta no encontrada.';
            return;
        }

        foreach ($route['middlewares'] as $middlewareClass) {
            (new $middlewareClass())->handle();
        }

        [$controllerClass, $action] = $route['handler'];
        $controller = new $controllerClass();
        $controller->$action();
    }
}
