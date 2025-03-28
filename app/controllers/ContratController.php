<?php
// Inclure le modèle Contrat
require_once __DIR__ . "/../models/Contrat.php";

// Contrôleur pour gérer les contrats
class ContratController {
    private $contratModel;

    // Constructeur pour initialiser le modèle Contrat
    public function __construct($db) {
        $this->contratModel = new Contrat($db);
    }

    // Affiche la liste de tous les contrats
    public function index() {
        $contrats = $this->contratModel->getAllContrats();
        require __DIR__ . "/../views/contrats/liste.php";
    }

    // Affiche le formulaire d'ajout pour ajouter un contrat.
    public function create() {
        // Récupérer tous les clients pour afficher la liste déroulante
        $clients = $this->contratModel->getAllClients(); 
    
        // Vérifie si le formulaire a été soumis en POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST['type_contrat']) && !empty($_POST['montant']) && !empty($_POST['duree']) && !empty($_POST['id_client'])) {
                $type_contrat = $_POST["type_contrat"];
                $montant = $_POST["montant"];
                $duree = $_POST["duree"];
                $id_client = $_POST["id_client"];
    
                // Ajouter le contrat en base de données
                if ($this->contratModel->addContrat($montant, $duree, $type_contrat, $id_client)) {
                    header("Location: index.php?controller=contrat&action=index&message=Contrat ajouté avec succès.");
                    exit();
                } else {
                    $error = "❌ Une erreur est survenue lors de l'ajout du contrat.";
                }
            } else {
                $error = "⚠️ Veuillez remplir tous les champs obligatoires.";
            }
        }
        // Afficher le formulaire d'ajout
        require __DIR__ . "/../views/contrats/ajouter.php";
    }

    // Affiche le formulaire de modification d'un contrat.
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=contrat&action=index");
            exit();
        }

        // Récupérer le contrat par son ID
        $id = $_GET['id'];
        $contrat = $this->contratModel->getContratById($id);
        // Rediriger si le contrat n'existe pas
        if (!$contrat) {
            header("Location: index.php?controller=contrat&action=index&error=Contrat introuvable.");
            exit();
        }
        // Afficher le formulaire de modification
        require __DIR__ . "/../views/contrats/modifier.php";
    }

    // Met à jour un contrat
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $montant = $_POST["montant"];
            $duree = $_POST["duree"];

            // Mettre à jour le contrat
            if ($this->contratModel->updateContrat($id, $montant, $duree)) {
                header("Location: index.php?controller=contrat&action=index&message=Contrat mis à jour avec succès.");
            } else {
                header("Location: index.php?controller=contrat&action=edit&id=$id&error=Erreur lors de la mise à jour.");
            }
            exit();
        }
    }

    // Supprime un contrat de la base de données
    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=contrat&action=index");
            exit();
        }
        // Récupérer l'ID du contrat à supprimer
        $id = $_GET['id'];
        // Supprimer le contrat
        if ($this->contratModel->deleteContrat($id)) {
            header("Location: index.php?controller=contrat&action=index&message=Contrat supprimé avec succès.");
        } else {
            header("Location: index.php?controller=contrat&action=index&error=Erreur lors de la suppression du contrat.");
        }
        exit();
    }
}