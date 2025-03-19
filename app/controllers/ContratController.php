<?php
require_once __DIR__ . "/../models/Contrat.php";

class ContratController {
    private $contratModel;

    public function __construct($db) {
        $this->contratModel = new Contrat($db);
    }

    // Affiche la liste des contrats
    public function index() {
        $contrats = $this->contratModel->getAllContrats();
        require __DIR__ . "/../views/contrats/liste.php";
    }

    // Affiche le formulaire d'ajout pour ajouter un contrat.
    public function create() {
        // Récupérer tous les clients pour permettre la sélection
        $clients = $this->contratModel->getAllClients(); 

        require __DIR__ . "/../views/contrats/ajouter.php";
    }

  // Ajouter un contrat à la base de données
    public function store() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $montant = $_POST["montant"];
            $duree = $_POST["duree"];
            $type = $_POST["type_contrat"];
            $id_client = $_POST["id_client"];

            if ($this->contratModel->addContrat($montant, $duree, $type, $id_client)) {
                header("Location: index.php?controller=contrat&action=index&message=Contrat ajouté avec succès.");
            } else {
                header("Location: index.php?controller=contrat&action=create&error=Erreur lors de l'ajout du contrat.");
            }
            exit();
        }
    }

    // Affiche le formulaire de modification d'un contrat.
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=contrat&action=index");
            exit();
        }

        $id = $_GET['id'];
        $contrat = $this->contratModel->getContratById($id);

        if (!$contrat) {
            header("Location: index.php?controller=contrat&action=index&error=Contrat introuvable.");
            exit();
        }

        require __DIR__ . "/../views/contrats/modifier.php";
    }

    // Met à jour un contrat
    public function update() {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $montant = $_POST["montant"];
            $duree = $_POST["duree"];

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

        $id = $_GET['id'];

        if ($this->contratModel->deleteContrat($id)) {
            header("Location: index.php?controller=contrat&action=index&message=Contrat supprimé avec succès.");
        } else {
            header("Location: index.php?controller=contrat&action=index&error=Erreur lors de la suppression du contrat.");
        }
        exit();
    }
}