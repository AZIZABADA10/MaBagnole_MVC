<?php

define('BASE_URL', '/mabagnole_mvc/public');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\VehiculeController;


session_start();

$router = new Router();

$router->add('/', HomeController::class, 'index');
$router->add('/login', AuthController::class, 'loginForm');
$router->add('/login_post', AuthController::class, 'login');
$router->add('/register', AuthController::class, 'registerForm');
$router->add('/register_post', AuthController::class, 'register');
$router->add('/logout', AuthController::class, 'logout');
$router->add('/vehicules/nos_voitures', VehiculeController::class, 'nosVoitures');

$router->add('/admin/dashboard', AdminController::class, 'dashboard');
$router->add('/vehicles',AdminController::class,'vehicles');
$router->add('/categories',AdminController::class,'categories');
$router->add('/reservations', AdminController::class, 'reservations');
$router->add('/reviews', AdminController::class, 'reviews');


$requestUri = str_replace(BASE_URL, '', $_SERVER['REQUEST_URI']);
$router->run($requestUri); 


