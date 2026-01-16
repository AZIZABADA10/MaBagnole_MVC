<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Vehicule;
use App\Models\Categorie;

class AdminController extends Controller
{
    
    public function dashboard()
    {
        $nom_admin = $_SESSION['user']['nom'];
        $this->view('admin/dashboard', compact('nom_admin'));
    }


    public function vehicles()
    {
        $this->checkAdmin();

        $vehicules = Vehicule::listerVehicule(100, 0);
        $categories = Categorie::listerCategorie();
        $nom_admin = $_SESSION['user']['nom'];
        $this->view('admin/vehicles', compact('vehicules', 'categories','nom_admin'));
    }

    public function ajouterVehicule()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicule = new Vehicule(
                $_POST['modele'],
                $_POST['marque'],
                (float)$_POST['prix_par_jour'],
                (int)$_POST['id_categorie'],
                $_POST['image'],
                isset($_POST['disponible'])
            );
            $vehicule->ajouterVehicule();
            header("Location: " . BASE_URL . "/admin/vehicles");
            exit;
        }
    }

    public function modifierVehicule()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicule = new Vehicule(
                $_POST['modele'],
                $_POST['marque'],
                (float)$_POST['prix_par_jour'],
                (int)$_POST['id_categorie'],
                $_POST['image'],
                isset($_POST['disponible']),
                (int)$_POST['id_vehicule']
            );

            $vehicule->modifierVehicule();
            header("Location: " . BASE_URL . "/admin/vehicles");
            exit;
        }
    }

    public function supprimerVehicule()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null; 
        if ($id) {
            Vehicule::supprimerVehicule($id);
        }

        header("Location: " . BASE_URL . "/admin/vehicles");
        exit;
    }




    private function checkAdmin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/login");
            exit;
        }
    }
}
