<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Vehicule;
use App\Models\Categorie;

class HomeController extends Controller
{
    public function index()
    {
        $vehicules = Vehicule::listerVehicule(4, 0);
        $categories = Categorie::listerCategorie();
        
        if (!$vehicules) {
            $vehicules = [];
        }
        
        if (!$categories) {
            $categories = [];
        }
        
        $this->view('home', [
            'vehicules' => $vehicules,
            'categories' => $categories
        ]);
    }
}