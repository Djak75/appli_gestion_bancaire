<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle pour gérer l'authentification de l'administrateur.
class Admin {
    private $conn;

    // Constructeur pour initialiser la connexion à la base 
    public function __construct() {
        // Connexion à la base de données
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Méthode pour connecter l'admin
    public function login(string $email, string $password): bool {
        // Requête pour récupérer l'admin par email
        $sql = "SELECT * FROM administrateur WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $admin = $stmt->fetch();

        // Vérifier si l'email existe et si le mot de passe correspond
        if ($admin && password_verify($password, $admin['mot_de_passe'])) {
            return true; // Connexion réussie
        }
        return false; // Connexion échouée
    }

    // Méthode pour récupérer l'admin par email
    public function getAdminByEmail(string $email) {
        // Requête pour récupérer l'admin par email
        $sql = "SELECT * FROM administrateur WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        // // Retourne l'admin 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}