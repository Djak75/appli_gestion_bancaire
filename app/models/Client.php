<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";

// Modèle Client pour gérer les clients
class Client {
    private $conn;

    // Constructeur pour initialiser la connexion à la base
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Méthode pour récupérer tous les clients
    public function getAllClients(): array {
        // Requête pour récupérer tous les clients
        $sql = "SELECT * FROM client";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll();
    }

     // Méthode pour ajouter un client
     public function addClient($nom, $prenom, $email, $telephone, $adresse = null) {
        // Récupérer le dernier ID pour générer un numéro unique
        $lastId = $this->conn->query("SELECT MAX(id) FROM client")->fetchColumn();
        // Générer un nouveau ID
        $newId = $lastId ? $lastId + 1 : 1;
    
        // Format : SIMP202501, SIMP202502...
        $numero_client = "SIMP" . date("Y") . str_pad($newId, 2, "0", STR_PAD_LEFT);
        // Requête pour ajouter un client
        $sql = "INSERT INTO client (numero_client, nom, prenom, email, telephone, adresse) 
                VALUES (:numero_client, :nom, :prenom, :email, :telephone, :adresse)";
        // Préparer la requête
        $stmt = $this->conn->prepare($sql);
        // Exécuter la requête
        return $stmt->execute([
            ':numero_client' => $numero_client,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse
        ]);
    }

    // Méthode pour modifier un client
    public function updateClient(int $id, string $nom, string $prenom, string $email, string $telephone, ?string $adresse = null): bool {
        // Requête pour modifier un client
        $sql = "UPDATE client SET nom = :nom, prenom = :prenom, email = :email, 
                telephone = :telephone, adresse = :adresse WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        // Exécuter la requête
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse
        ]);
    }

    // Méthode pour récupérer un client par son identifiant
    public function getClientById(int $id) {
        // Requête pour récupérer un client par son identifiant
        $sql = "SELECT * FROM client WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // Retourne le client
        return $stmt->fetch();
    }

    // Méthode pour vérifier si un client a des comptes bancaires
    public function hasAccounts(int $id): bool {
        // Requête pour vérifier si un client a des comptes bancaires
        $sql = "SELECT COUNT(*) FROM compte WHERE id_client = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        // Retourne true si le client a des comptes, sinon false
        return $stmt->fetchColumn() > 0;
    }

    // Méthode pour supprimer un client
    public function deleteClient(int $id): bool {
        try {
            // Démarrer une transaction pour garantir la cohérence des données
            $this->conn->beginTransaction();

            // Supprimer les comptes bancaires du client
            $sqlDeleteAccounts = "DELETE FROM compte WHERE id_client = :id";
            $stmtAccounts = $this->conn->prepare($sqlDeleteAccounts);
            $stmtAccounts->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtAccounts->execute();

            // Supprimer le client
            $sqlDeleteClient = "DELETE FROM client WHERE id = :id";
            $stmtClient = $this->conn->prepare($sqlDeleteClient);
            $stmtClient->bindParam(":id", $id, PDO::PARAM_INT);
            $stmtClient->execute();

            // Valider la transaction
            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            $this->conn->rollBack();
            return false;
        }
    }
    // Méthode pour récupérer le nombre total de clients
    public function getTotalClients(): int {
        $sql = "SELECT COUNT(*) FROM client";
        $stmt = $this->conn->query($sql);
        // Retourne le nombre total de clients
        return (int) $stmt->fetchColumn();
    }

    // Méthode pour récupérer les clients 
    public function getComptesByClient($id_client) {
        // Requête pour récupérer les comptes par client
        $sql = "SELECT * FROM compte WHERE id_client = :id_client";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        $stmt->execute();
        // Retourne les comptes
        return $stmt->fetchAll();
    }

    // Méthode pour récupérer les contrats par client
    public function getContratsByClient($id_client) {
        // Requête pour récupérer les contrats par client
        $sql = "SELECT * FROM contrat WHERE id_client = :id_client";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        $stmt->execute();
        // Retourne les contrats
        return $stmt->fetchAll();
    }

    
}


