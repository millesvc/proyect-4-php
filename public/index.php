<?php

declare(strict_types=1);

session_start();

$baseUrl = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? '')), '/');
define('BASE_URL', $baseUrl === '/' ? '' : $baseUrl);

require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$router = new Router();

$router->get('/', [AuthController::class, 'showLogin']);
$router->get('login', [AuthController::class, 'showLogin']);
$router->post('login', [AuthController::class, 'login']);
$router->post('logout', [AuthController::class, 'logout'], [AuthMiddleware::class]);

$router->get('products', [ProductController::class, 'index'], [AuthMiddleware::class]);
$router->get('products/create', [ProductController::class, 'create'], [AuthMiddleware::class]);
$router->post('products/store', [ProductController::class, 'store'], [AuthMiddleware::class]);
$router->get('products/show', [ProductController::class, 'show'], [AuthMiddleware::class]);
$router->get('products/edit', [ProductController::class, 'edit'], [AuthMiddleware::class]);
$router->post('products/update', [ProductController::class, 'update'], [AuthMiddleware::class]);
$router->post('products/delete', [ProductController::class, 'destroy'], [AuthMiddleware::class]);

$route = trim((string)($_GET['route'] ?? '/'), '/');
$route = $route === '' ? '/' : $route;
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

$router->dispatch($method, $route);
