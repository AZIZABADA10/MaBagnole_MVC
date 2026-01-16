<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Categorie;

class CategorieController extends Controller
{
    public function index()
    {
        $this->checkAdmin();
        $categories = Categorie::listerCategorie();
        $nom_admin = $_SESSION['user']['nom'];
        $this->view('admin/categories', compact('categories','nom_admin'));
    }

    public function ajouter()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = new Categorie(
                $_POST['titre'],
                $_POST['description']
            );
            $categorie->ajouterCategorie();
            header("Location: " . BASE_URL . "/admin/categories");
            exit;
        }

        $this->view('admin/categories_ajouter');
    }

    public function modifier()
    {
        $this->checkAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie = new Categorie(
                $_POST['titre'],
                $_POST['description'],
                (int)$_POST['id']
            );
            $categorie->modifierCategorie();
            header("Location: " . BASE_URL . "/admin/categories");
            exit;
        }
    }

    public function supprimer()
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: " . BASE_URL . "/admin/categories");
            exit;
        }

        $categorie = new Categorie('', '', (int)$id);

        if ($categorie->estUtilisee()) {
            $_SESSION['error'] = "Impossible de supprimer : catégorie utilisée par des véhicules.";
        } else {
            $categorie->supprimerCategorie();
            $_SESSION['success'] = "Catégorie supprimée avec succès.";
        }

        header("Location: " . BASE_URL . "/admin/categories");
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
