<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Reservation;
use App\Models\Vehicule;

class ReservationController extends Controller
{
    /** Réserver un véhicule */
    public function reserver()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reservation = new Reservation(
                $_SESSION['user']['id_utilisateur'],
                (int)$_POST['id_vehicule'],
                $_POST['date_debut'],
                $_POST['date_fin']
            );

            $reservation->ajouterReservation();

            header("Location: " . BASE_URL . "/mes-reservations");
            exit;
        }

        // affichage formulaire
        $id_vehicule = $_GET['id'] ?? null;
        $vehicule = Vehicule::getVehiculeById($id_vehicule);

        $this->view('reservation/reserver', compact('vehicule'));
    }

    /** Liste des réservations de l'utilisateur */
    public function mesReservations()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $reservations = Reservation::listerReservationsParUtilisateur(
            $_SESSION['user']['id_utilisateur']
        );

        $this->view('reservation/mes_reservations', compact('reservations'));
    }

    /** Annuler une réservation */
    public function annuler()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: " . BASE_URL . "/login");
            exit;
        }

        $reservation = new Reservation(
            $_SESSION['user']['id_utilisateur'],
            (int)$_GET['id_vehicule'],
            '',
            ''
        );

        $reservation->annulerReservation();
        header("Location: " . BASE_URL . "/mes-reservations");
        exit;
    }

    /** ===== ADMIN ===== */

    public function toutesReservations()
    {
        $this->checkAdmin();

        $reservations = Reservation::listerToutesLesReservations();
        $this->view('admin/reservations', compact('reservations'));
    }

    public function confirmer()
    {
        $this->checkAdmin();

        $reservation = new Reservation(
            (int)$_GET['id_user'],
            (int)$_GET['id_vehicule'],
            '',
            ''
        );

        $reservation->confirmerReservation();
        header("Location: " . BASE_URL . "/admin/reservations");
        exit;
    }

    public function refuser()
    {
        $this->checkAdmin();

        $reservation = new Reservation(
            (int)$_GET['id_user'],
            (int)$_GET['id_vehicule'],
            '',
            ''
        );

        $reservation->annulerReservation();
        header("Location: " . BASE_URL . "/admin/reservations");
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
