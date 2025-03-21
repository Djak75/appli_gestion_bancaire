<?php
// Inclure la connexion à la base de données
require_once __DIR__ . "/../../config/database.php";
// Inclure le modèle Client
require_once __DIR__ . "/../models/Client.php";
// Inclure le modèle Compte
require_once __DIR__ . "/../models/Compte.php";
// Inclure le modèle Contrat
require_once __DIR__ . "/../models/Contrat.php";

// Contrôleur pour gérer le tableau de bord
class DashboardController {
    private $clientModel;
    private $compteModel;
    private $contratModel;

    // Constructeur pour initialiser les modèles
    public function __construct() {
        // Créer la connexion à la base de données
        $db = (new Database())->getConnection();

        // Initialiser les modèles
        $this->clientModel = new Client($db);
        $this->compteModel = new Compte($db);
        $this->contratModel = new Contrat($db);
    }

    // Affiche le tableau de bord
    public function index() {
        $totalClients = $this->clientModel->getTotalClients();
        $totalComptes = $this->compteModel->getTotalComptes();
        $totalContrats = $this->contratModel->getTotalContrats();

        // Inclure la vue du tableau de bord
        require __DIR__ . "/../views/dashboard.php";
    }
}
