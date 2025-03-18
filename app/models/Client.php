<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle Client pour gérer les clients
class Client {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /**
     * Récupère tous les clients enregistrés dans la base de données.
     * @return array Liste des clients
     */
    public function getAllClients() {
        $sql = "SELECT * FROM client";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }
}

