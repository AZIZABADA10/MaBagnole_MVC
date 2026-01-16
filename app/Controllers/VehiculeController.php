<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Vehicule;
use App\Models\Categorie;

class VehiculeController extends Controller
{
    public function nosVoitures()
    {
        $page = $_GET['page'] ?? 1;
        $limit = 6;
        $offset = ($page - 1) * $limit;

        $vehicules = Vehicule::listerVehicule($limit, $offset); 
        $categories = Categorie::listerCategorie();            
        $total = Vehicule::count();
        $totalPages = ceil($total / $limit);

        $this->view('vehicules/nos-voiture', [
            'vehicules' => $vehicules,
            'categories' => $categories,
            'page' => $page,
            'totalPages' => $totalPages
        ]);
    }
}
