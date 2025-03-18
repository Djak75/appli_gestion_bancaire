<?php
// Inclure le modèle Client
require_once __DIR__ . "/../models/Client.php";

// Contrôleur pour gérer les clients
class ClientController {
    private $clientModel;

    public function __construct() {
        $this->clientModel = new Client();
    }

    // Affiche la liste de tous les clients
    public function index() {
        // Récupérer tous les clients
        $clients = $this->clientModel->getAllClients();
        require __DIR__ . "/../views/clients/liste.php";
    }
}

