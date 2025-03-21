<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle Compte pour gérer les comptes bancaires
class Compte {
    private $conn;

    // Constructeur pour initialiser la connexion à la base
    public function __construct(PDO $db) {
        // Connexion à la base de données
        $this->conn = $db;
    }

    // Méthode pour récupérer tous les comptes
    public function getAllComptes(): array {
        // Requête pour récupérer tous les comptes
        $sql = "SELECT compte.*, client.nom, client.prenom 
                FROM compte 
                JOIN client ON compte.id_client = client.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Retourne tous les comptes
        return $stmt->fetchAll();
    }

    // Méthode pour récupérer un compte par son identifiant
    public function getCompteById(int $id) {
        $sql = "SELECT * FROM compte WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Méthode pour ajouter un compte
    public function addCompte(string $rib, float $solde, string $type, int $id_client): bool {
        // Requête pour ajouter un compte
        $sql = "INSERT INTO compte (rib, solde, type_compte, id_client) VALUES (:rib, :solde, :type, :id_client)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":rib", $rib);
        $stmt->bindParam(":solde", $solde);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
    }

    // Méthode pour modifier un compte
    public function updateCompte(int $id, float $solde, string $type): bool {
        // Requête pour modifier un compte
        $sql = "UPDATE compte SET solde = :solde, type_compte = :type WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":solde", $solde);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
    }

    // Méthode pour supprimer un compte
    public function deleteCompte(int $id): bool {
        // Requête pour supprimer un compte
        $sql = "DELETE FROM compte WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
    }

    // Méthode pour récupérer tous les clients
    public function getAllClients(): array {
        // Requête pour récupérer tous les clients
        $sql = "SELECT id, nom, prenom FROM client";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Retourne tous les clients
        return $stmt->fetchAll();
    }

    // Méthode pour récupérer le nombre total de comptes
    public function getTotalComptes(): int {
        $sql = "SELECT COUNT(*) FROM compte";
        $stmt = $this->conn->query($sql);
        // Retourne le nombre total de comptes
        return (int) $stmt->fetchColumn();
    }
}