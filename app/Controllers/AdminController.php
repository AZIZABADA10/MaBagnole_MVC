<?php

namespace App\Controllers;

use App\Core\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $this->view('admin/dashboard', [
            'nom_admin' => $_SESSION['user']['nom']
        ]);
    }

    public function vehicles()
    {
        $this->view('admin/vehicles', [
            'nom_admin' => $_SESSION['user']['nom']
        ]);
    }

    public function categories()
    {
        $this->view('admin/categories', [
            'nom_admin' => $_SESSION['user']['nom']
        ]);
    }

    public function reservations()
    {
        $this->view('admin/reservations', [
            'nom_admin' => $_SESSION['user']['nom']
        ]);
    }

    public function reviews()
    {
        $this->view('admin/reviews', [
            'nom_admin' => $_SESSION['user']['nom']
        ]);
    }
}
