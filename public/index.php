<?php
declare(strict_types=1);
require dirname(__DIR__).'/vendor/autoload.php';
$dotenv=Dotenv\Dotenv::createImmutable(dirname(__DIR__));
if(is_file(dirname(__DIR__).'/.env')) $dotenv->load();
require dirname(__DIR__).'/app/Core/helpers.php';
use App\Core\Application;
use App\Core\Router;
use App\Core\Session;
use App\Controllers\HomeController;
use App\Controllers\BlogController;
use App\Controllers\Admin\AuthController as AdminAuthController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\UsersController;
use App\Controllers\Admin\SettingsController;
use App\Controllers\Admin\BlogController as AdminBlogController;
Session::start();
$router=new Router();
// Public
$router->get('/',[HomeController::class,'index']);
$router->get('/blog',[BlogController::class,'index']);
$router->get('/blog/{slug}',[BlogController::class,'show']);
// Admin auth
$router->get('/admin/login',[AdminAuthController::class,'loginForm']);
$router->post('/admin/login',[AdminAuthController::class,'login']);
$router->post('/admin/logout',[AdminAuthController::class,'logout']);
// Admin
$router->get('/admin',[DashboardController::class,'index']);
$router->get('/admin/users',[UsersController::class,'index']);
$router->post('/admin/users/create',[UsersController::class,'create']);
$router->get('/admin/settings',[SettingsController::class,'index']);
$router->post('/admin/settings/save',[SettingsController::class,'save']);
$router->get('/admin/blog',[AdminBlogController::class,'index']);
$router->get('/admin/blog/create',[AdminBlogController::class,'createForm']);
$router->post('/admin/blog/store',[AdminBlogController::class,'store']);
$router->get('/admin/blog/edit/{id}',[AdminBlogController::class,'editForm']);
$router->post('/admin/blog/update/{id}',[AdminBlogController::class,'update']);
$router->post('/admin/blog/delete/{id}',[AdminBlogController::class,'delete']);
$app=new Application($router);
$app->run();
