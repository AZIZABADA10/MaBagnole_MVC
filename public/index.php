<?php

define('BASE_URL', '/mabagnole_mvc/public');

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\AdminController;
use App\Controllers\VehiculeController;
use App\Controllers\CategorieController;



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
$router->add('/admin/vehicles', AdminController::class, 'vehicles');
$router->add('/admin/categories', CategorieController::class, 'index');

$router->add('/admin/reviews', AdminController::class, 'reviews');
$router->add('/admin/vehicule/ajouter', AdminController::class, 'ajouterVehicule');
$router->add('/admin/vehicule/modifier', AdminController::class, 'modifierVehicule');
$router->add('/admin/vehicule/supprimer/{id}', AdminController::class, 'supprimerVehicule');
$router->add('/admin/vehicule/supprimer', AdminController::class, 'supprimerVehicule');

$router->add('/admin/categorie/ajouter', CategorieController::class, 'ajouter');
$router->add('/admin/categorie/modifier', CategorieController::class, 'modifier');
$router->add('/admin/categorie/supprimer', CategorieController::class, 'supprimer');



$requestUri = str_replace(BASE_URL, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$router->run($requestUri); 



