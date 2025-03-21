<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle Contrat pour gérer les contrats
class Contrat {
    private $conn;

   // Constructeur pour initialiser la connexion à la base
    public function __construct(PDO $db) {
        $this->conn = $db;
    }

    // Méthode pour récupérer tous les contrats
    public function getAllContrats(): array {
        // Requête pour récupérer tous les contrats
        $sql = "SELECT contrat.*, client.nom, client.prenom 
                FROM contrat 
                JOIN client ON contrat.id_client = client.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        // Retourne tous les contrats
        return $stmt->fetchAll();
    }

    // Méthode pour récupérer un contrat par son identifiant
    public function getContratById(int $id):array|false {
        // Requête pour récupérer un contrat par son identifiant
        $sql = "SELECT * FROM contrat WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // Retourne le contrat
        return $stmt->fetch();
    }

    // Méthode pour ajouter un contrat
    public function addContrat(float $montant, int $duree, string $type_contrat, int $id_client): bool {
        // Requête pour ajouter un contrat
        $sql = "INSERT INTO contrat (montant, duree, type_contrat, id_client) 
                VALUES (:montant, :duree, :type_contrat, :id_client)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":duree", $duree, PDO::PARAM_INT);
        $stmt->bindParam(":type_contrat", $type_contrat); // Correction ici
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
    }

    // Méthode pour modifier un contrat
    public function updateContrat(int $id, float $montant, int $duree): bool {
        // Requête pour modifier un contrat
        $sql = "UPDATE contrat SET montant = :montant, duree = :duree WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":duree", $duree, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        // Exécuter la requête
        return $stmt->execute();
    }

    // Méthode pour supprimer un contrat
    public function deleteContrat(int $id): bool {
        // Requête pour supprimer un contrat
        $sql = "DELETE FROM contrat WHERE id = :id";
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

    // Méthode pour récupérer le nombre total de contrats
    public function getTotalContrats(): int {
        $sql = "SELECT COUNT(*) FROM contrat";
        $stmt = $this->conn->query($sql);
        // Retourne le nombre total de contrats
        return (int) $stmt->fetchColumn();
    }
    
}