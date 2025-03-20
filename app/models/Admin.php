<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle pour gérer l'authentification de l'administrateur
class Admin {
    private $conn;

    public function __construct() {
        // Obtenir la connexion PDO
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Vérifie si l'email et le mot de passe sont corrects.
     * @param string $email Email de l'admin
     * @param string $password Mot de passe non haché
     * @return bool Indique si la connexion est valide
     */
    public function login($email, $password) {
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

    public function getAdminByEmail($email) {
        $sql = "SELECT * FROM administrateur WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retourne l'admin ou false si introuvable
    }
}