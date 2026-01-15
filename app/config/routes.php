<?php

use App\Controllers\AuthController;
use App\Controllers\HomeController;

$router->add('/', HomeController::class, 'index');

$router->add('/login', AuthController::class, 'loginForm');
$router->add('/login_post', AuthController::class, 'login');

$router->add('/register', AuthController::class, 'registerForm');
$router->add('/register_post', AuthController::class, 'register');
$router->add('/logout', AuthController::class, 'logout');
