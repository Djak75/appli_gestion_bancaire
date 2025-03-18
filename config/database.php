<?php
// Classe Database pour gérer la connexion à la base de données en POO.
class Database {
    // Déclaration des informations de connexion
    private $host = "localhost";
    private $dbname = "gestion_bancaire";
    private $username = "root"; 
    private $password = "";
    private $conn;

    /**
     * Établit la connexion à la base de données.
     * @return PDO|null Retourne un objet PDO si la connexion est réussie, sinon null.
     */
    public function getConnection() {
        // Vérifier si la connexion n'existe pas déjà
        if ($this->conn === null) {
            try {
                // Connexion sécurisée avec PDO
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                    $this->username,
                    $this->password
                );
                // Activer les erreurs PDO en mode exception
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $exception) {
                // En cas d'erreur, afficher le message et arrêter l'exécution
                die("❌ Erreur de connexion : " . $exception->getMessage());
            }
        }
        return $this->conn;
    }
}