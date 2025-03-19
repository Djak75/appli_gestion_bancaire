<?php

class Compte {
    private $conn;

    /**
     * Constructeur pour initialiser la connexion à la base de données.
     * @param PDO $db Connexion PDO à la base de données
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Récupère tous les comptes bancaires avec les informations du client associé.
     * @return array Retourne un tableau contenant tous les comptes bancaires.
     */
    public function getAllComptes() {
        $sql = "SELECT compte.*, client.nom, client.prenom 
                FROM compte 
                JOIN client ON compte.id_client = client.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère un compte par son ID.
     * @param int $id L'identifiant du compte
     * @return array|false Retourne les informations du compte ou false si non trouvé.
     */
    public function getCompteById($id) {
        $sql = "SELECT * FROM compte WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Ajoute un compte bancaire à la base de données.
     * @param string $rib RIB du compte
     * @param float $solde Solde initial du compte
     * @param string $type Type de compte ('Courant' ou 'Épargne')
     * @param int $id_client ID du client associé
     * @return bool Retourne true si l'insertion est réussie, sinon false.
     */
    public function addCompte($rib, $solde, $type, $id_client) {
        $sql = "INSERT INTO compte (rib, solde, type_compte, id_client) VALUES (:rib, :solde, :type, :id_client)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":rib", $rib);
        $stmt->bindParam(":solde", $solde);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Met à jour un compte bancaire.
     * @param int $id ID du compte
     * @param float $solde Nouveau solde
     * @param string $type Nouveau type de compte
     * @return bool Retourne true si la mise à jour est réussie, sinon false.
     */
    public function updateCompte($id, $solde, $type) {
        $sql = "UPDATE compte SET solde = :solde, type_compte = :type WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":solde", $solde);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Supprime un compte bancaire.
     * @param int $id ID du compte
     * @return bool Retourne true si la suppression est réussie, sinon false.
     */
    public function deleteCompte($id) {
        $sql = "DELETE FROM compte WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

        /**
     * Récupère tous les clients pour l'affichage dans le formulaire d'ajout de compte.
     * @return array Retourne un tableau contenant tous les clients.
     */
    public function getAllClients() {
        $sql = "SELECT id, nom, prenom FROM client";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}