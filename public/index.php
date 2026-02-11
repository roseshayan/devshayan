<?php

declare(strict_types=1);
require dirname(__DIR__) . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if (is_file(dirname(__DIR__) . '/.env')) $dotenv->load();
require dirname(__DIR__) . '/app/Core/helpers.php';

use App\Core\Application;
use App\Core\Router;
use App\Core\Session;
use App\Controllers\HomeController;
use App\Controllers\Admin\AuthController as AdminAuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\UsersController;

Session::start();
$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$router->get('/admin/login', [AdminAuthController::class, 'loginForm']);
$router->post('/admin/login', [AdminAuthController::class, 'login']);
$router->post('/admin/logout', [AdminAuthController::class, 'logout']);
$router->get('/admin', [DashboardController::class, 'index']);
$router->get('/admin/users', [UsersController::class, 'index']);
$router->post('/admin/users/create', [UsersController::class, 'create']);
$app = new Application($router);
$app->run();
