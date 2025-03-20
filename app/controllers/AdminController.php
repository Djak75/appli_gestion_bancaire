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
        session_start(); // Assurer que la session est démarrée

        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Vérifie si l'admin existe en base de données
            $admin = $this->adminModel->getAdminByEmail($email);

            if ($admin && password_verify($password, $admin['mot_de_passe'])) {
                $_SESSION['admin'] = $email;
                header("Location: index.php?controller=client&action=index");
                exit();
            } else {
                $_SESSION['error_message'] = " Identifiants incorrects. Vérifiez votre email et votre mot de passe.";
            }
        } else {
            $_SESSION['error_message'] = "⚠️ Veuillez remplir tous les champs.";
        }

        // Rediriger vers la page de connexion avec le message d'erreur
        header("Location: index.php?controller=admin&action=loginForm");
        exit();
    }

    // Gère la déconnexion de l'administrateur
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=admin&action=loginForm");
        exit();
    }
}