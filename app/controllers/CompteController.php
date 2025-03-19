<?php
require_once __DIR__ . "/../models/Compte.php";

class CompteController {
    private $compteModel;

    public function __construct($db) {
        $this->compteModel = new Compte($db);
    }

    
    // Affiche la liste des comptes bancaires
    public function index() {
        $comptes = $this->compteModel->getAllComptes();
        require __DIR__ . "/../views/comptes/liste.php";
    }

  
    // Affiche le formulaire de modification d'un compte
public function edit() {
    if (!isset($_GET['id'])) {
        header("Location: index.php?controller=compte&action=index");
        exit();
    }

    $id = $_GET['id'];
    $compte = $this->compteModel->getCompteById($id);

    if (!$compte) {
        header("Location: index.php?controller=compte&action=index&error=Compte introuvable.");
        exit();
    }

    require __DIR__ . "/../views/comptes/modifier.php";
}

// Met à jour un compte bancaire
public function update() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id = $_POST["id"];
        $solde = $_POST["solde"];
        $type = $_POST["type_compte"];

        if ($this->compteModel->updateCompte($id, $solde, $type)) {
            header("Location: index.php?controller=compte&action=index&message=Compte mis à jour avec succès.");
        } else {
            header("Location: index.php?controller=compte&action=edit&id=$id&error=Erreur lors de la mise à jour.");
        }
        exit();
    }
}

// Supprime un compte bancaire
public function delete() {
    if (!isset($_GET['id'])) {
        header("Location: index.php?controller=compte&action=index");
        exit();
    }

    $id = $_GET['id'];

    if ($this->compteModel->deleteCompte($id)) {
        header("Location: index.php?controller=compte&action=index&message=Compte supprimé avec succès.");
    } else {
        header("Location: index.php?controller=compte&action=index&error=Erreur lors de la suppression.");
    }
    exit();
}


// Affiche le formulaire d'ajout d'un compte
public function create() {
    // Récupérer tous les clients pour permettre la sélection
    $clients = $this->compteModel->getAllClients(); 

    require __DIR__ . "/../views/comptes/ajouter.php";
}

// Ajoute un compte bancaire à la base de données
public function store() {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $rib = $_POST["rib"];
        $solde = $_POST["solde"];
        $type = $_POST["type_compte"];
        $id_client = $_POST["id_client"];

        if ($this->compteModel->addCompte($rib, $solde, $type, $id_client)) {
            header("Location: index.php?controller=compte&action=index&message=Compte ajouté avec succès.");
        } else {
            header("Location: index.php?controller=compte&action=create&error=Erreur lors de l'ajout du compte.");
        }
        exit();
    }
}

}
