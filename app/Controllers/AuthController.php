<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Utilisateur;
use App\Models\Client;

class AuthController extends Controller
{
    public function loginForm()
    {
        $this->view('auth/login');
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['mot_de_passe'] ?? '';

        $result = Utilisateur::login($email, $password);

        if (!$result['success']) {
            $this->view('auth/login', [
                'error' => $result['message']
            ]);
            return;
        }

        $role = $_SESSION['user']['role'];

        if ($role === 'admin') {
            header("Location:" . BASE_URL . "/admin/dashboard");
        } else {
            header("Location:". BASE_URL . "/vehicles");
        }
        exit;
    }

    public function registerForm()
    {
        $this->view('auth/register');
    }

    public function register()
    {
        $result = Client::register($_POST['nom'],$_POST['email'],$_POST['mot_de_passe']);

        if (!$result['success']) {
            $this->view('auth/register', [
                'error' => $result['message']
            ]);
            return;
        }

        header("Location:". BASE_URL ."/login");
        exit;
    }

    public function logout()
    {
        Utilisateur::logout();
        header("Location:". BASE_URL ."/login");
        exit;
    }
}
