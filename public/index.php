<?php

declare(strict_types=1);
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Core\Application;
use App\Core\Router;
use App\Controllers\HomeController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if (is_file(dirname(__DIR__) . '/.env')) $dotenv->load();
$router = new Router();
$router->get('/', [HomeController::class, 'index']);
$app = new Application($router);
$app->run();
