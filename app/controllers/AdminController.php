<?php
// Inclure le modèle Admin
require_once __DIR__ . "/../models/Admin.php";

// Contrôleur pour gérer l'authentification de l'administrateur
class AdminController {
    private $adminModel;

    public function __construct() {
        $this->adminModel = new Admin();
    }

    // Affiche la page de connexion de l'administrateur
    public function loginForm() {
        require __DIR__ . "/../views/admin/login.php";
    }

    // Gère la connexion de l'administrateur
    public function login() {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifie l'authentification
            if ($this->adminModel->login($email, $password)) {
                session_start();
                $_SESSION['admin'] = $email;
                header("Location: index.php?controller=client&action=index");
                exit();
            } else {
                $error = "Identifiants incorrects.";
            }
        } else {
            $error = "Veuillez remplir tous les champs.";
        }

        // Afficher la page de connexion avec un message d'erreur
        require __DIR__ . "/../views/admin/login.php";
    }

    // Gère la déconnexion de l'administrateur
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=admin&action=loginForm");
        exit();
    }
}