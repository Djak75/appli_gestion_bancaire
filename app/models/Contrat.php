<?php

class Contrat {
    private $conn;

    /**
     * Constructeur pour initialiser la connexion à la base de données.
     * @param PDO $db Connexion PDO à la base de données
     */
    public function __construct($db) {
        $this->conn = $db;
    }

    /**
     * Récupère tous les contrats avec les informations du client associé.
     * @return array Retourne un tableau contenant tous les contrats.
     */
    public function getAllContrats() {
        $sql = "SELECT contrat.*, client.nom, client.prenom 
                FROM contrat 
                JOIN client ON contrat.id_client = client.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    /**
     * Récupère un contrat par son ID.
     * @param int $id L'identifiant du contrat
     * @return array|false Retourne les informations du contrat ou false si non trouvé.
     */
    public function getContratById($id) {
        $sql = "SELECT * FROM contrat WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Ajoute un contrat à la base de données.
     * @param float $montant Montant souscrit
     * @param int $duree Durée en mois
     * @param string $type Type de contrat
     * @param int $id_client ID du client associé
     * @return bool Retourne true si l'insertion est réussie, sinon false.
     */
    public function addContrat($montant, $duree, $type, $id_client) {
        $sql = "INSERT INTO contrat (montant, duree, type_contrat, id_client) VALUES (:montant, :duree, :type, :id_client)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":duree", $duree, PDO::PARAM_INT);
        $stmt->bindParam(":type", $type);
        $stmt->bindParam(":id_client", $id_client, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Met à jour un contrat.
     * @param int $id ID du contrat
     * @param float $montant Nouveau montant
     * @param int $duree Nouvelle durée
     * @return bool Retourne true si la mise à jour est réussie, sinon false.
     */
    public function updateContrat($id, $montant, $duree) {
        $sql = "UPDATE contrat SET montant = :montant, duree = :duree WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":montant", $montant);
        $stmt->bindParam(":duree", $duree, PDO::PARAM_INT);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /**
     * Supprime un contrat.
     * @param int $id ID du contrat
     * @return bool Retourne true si la suppression est réussie, sinon false.
     */
    public function deleteContrat($id) {
        $sql = "DELETE FROM contrat WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

        /**
     * Récupère tous les clients pour l'affichage dans le formulaire d'ajout de contrat.
     * @return array Retourne un tableau contenant tous les clients.
     */
    public function getAllClients() {
        $sql = "SELECT id, nom, prenom FROM client";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}