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

        /**
     * Ajoute un nouveau client à la base de données.
     * @param string $nom Nom du client
     * @param string $prenom Prénom du client
     * @param string $email Email du client
     * @param string $telephone Téléphone du client
     * @param string $adresse Adresse du client 
     * @return bool Retourne true si l'ajout est réussi, sinon false
     */
    public function addClient($nom, $prenom, $email, $telephone, $adresse = null) {
        $sql = "INSERT INTO client (nom, prenom, email, telephone, adresse) 
                VALUES (:nom, :prenom, :email, :telephone, :adresse)";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse
        ]);
    }

    // Modifier un client

        /**
     * Met à jour les informations d'un client.
     * @param int $id ID du client à modifier
     * @param string $nom Nom du client
     * @param string $prenom Prénom du client
     * @param string $email Email du client
     * @param string $telephone Téléphone du client
     * @param string $adresse Adresse du client (optionnelle)
     * @return bool Retourne true si la mise à jour est réussie, sinon false
     */
    public function updateClient($id, $nom, $prenom, $email, $telephone, $adresse = null) {
        $sql = "UPDATE client SET nom = :nom, prenom = :prenom, email = :email, 
                telephone = :telephone, adresse = :adresse WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        
        return $stmt->execute([
            ':id' => $id,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':adresse' => $adresse
        ]);
    }

        /**
     * Récupère un client par son ID.
     * @param int $id L'identifiant du client
     * @return array|false Retourne les informations du client ou false s'il n'existe pas
     */
    public function getClientById($id) {
        $sql = "SELECT * FROM client WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

 
    /**
     * Vérifie si un client possède des comptes bancaires.
     * @param int $id L'identifiant du client
     * @return bool Retourne true si le client a des comptes, sinon false
     */
    public function hasAccounts($id) {
        $sql = "SELECT COUNT(*) FROM compte WHERE id_client = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Supprime un client et ses comptes bancaires si nécessaire.
     * @param int $id L'identifiant du client
     * @return bool Retourne true si la suppression a réussi, sinon false
     */
    public function deleteClient($id) {
        try {
            // Démarrer une transaction pour garantir la cohérence des données
            $this->conn->beginTransaction();

            // Supprimer les comptes associés si nécessaire
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

}


