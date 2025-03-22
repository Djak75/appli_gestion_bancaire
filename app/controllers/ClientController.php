<?php
// Inclure le modèle Client
require_once __DIR__ . "/../models/Client.php";

// Contrôleur pour gérer les clients
class ClientController {
    private $clientModel;

    // Constructeur pour initialiser le modèle Client
    public function __construct() {
        $this->clientModel = new Client();
    }

    // Affiche la liste de tous les clients
    public function index() {
        // Récupérer tous les clients
        $clients = $this->clientModel->getAllClients();
        require __DIR__ . "/../views/clients/liste.php";
    }


    // Affiche le formulaire d'ajout pour ajouter un client.
    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['telephone'])) {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $telephone = $_POST['telephone'];
                $adresse = $_POST['adresse'] ?? null;

                // Ajouter le client en base
                if ($this->clientModel->addClient($nom, $prenom, $email, $telephone, $adresse)) {
                    header("Location: index.php?controller=client&action=index");
                    exit();
                } else {
                    $error = "Erreur lors de l'ajout du client.";
                }
            } else {
                $error = "Veuillez remplir tous les champs obligatoires.";
            }
        }

        // Afficher le formulaire d'ajout
        require __DIR__ . "/../views/clients/ajouter.php";
    }

    // Affiche le formulaire de modification pour modifier un client.
    public function edit() {
        // Vérifier si un ID est passé en paramètre
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=client&action=index");
            exit();
        }
        // Récupérer le client par son ID
        $id = $_GET['id'];
        $client = $this->clientModel->getClientById($id);

        // Rediriger si le client n'existe pas
        if (!$client) {
            header("Location: index.php?controller=client&action=index");
            exit();
        }

        // Si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $adresse = $_POST['adresse'] ?? null;

            // Mettre à jour le client
            if ($this->clientModel->updateClient($id, $nom, $prenom, $email, $telephone, $adresse)) {
                header("Location: index.php?controller=client&action=index");
                exit();
            } else {
                $error = "Erreur lors de la modification.";
            }
        }
        // Afficher le formulaire de modification
        require __DIR__ . "/../views/clients/modifier.php";
    }

    // Supprime un client et ses comptes associés
    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=client&action=index");
            exit();
        }
        // Récupérer l'ID du client
        $id = $_GET['id'];

        // Supprimer le client et ses comptes associés si nécessaire
        if ($this->clientModel->deleteClient($id)) {
            header("Location: index.php?controller=client&action=index&message=Client et ses comptes supprimés avec succès.");
        } else {
            header("Location: index.php?controller=client&action=index&error=Erreur lors de la suppression.");
        }
        exit();
    }
    // Affiche le dossier d'un client avec ses comptes et contrats
    public function voirDossier() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=client&action=index&error=Aucun client sélectionné.");
            exit();
        }
        // Récupérer le client par son ID
        $id = $_GET['id'];
        // Récupérer les comptes et contrats du client
        $client = $this->clientModel->getClientById($id);
        $comptes = $this->clientModel->getComptesByClient($id);
        $contrats = $this->clientModel->getContratsByClient($id);
        
        // Rediriger si le client n'existe pas
        if (!$client) {
            header("Location: index.php?controller=client&action=index&error=Client introuvable.");
            exit();
        }
        // Afficher le dossier du client
        require __DIR__ . "/../views/clients/voir.php";
    }
    
}


