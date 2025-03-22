<?php
// Inclure le modèle Compte
require_once __DIR__ . "/../models/Compte.php";

// Contrôleur pour gérer les comptes bancaires
class CompteController {
    private $compteModel;

    // Constructeur pour initialiser le modèle Compte
    public function __construct($db) {
        $this->compteModel = new Compte($db);
    }

    // Affiche la liste des comptes bancaires
    public function index() {
        $comptes = $this->compteModel->getAllComptes();
        require __DIR__ . "/../views/comptes/liste.php";
    }

    // Affiche le formulaire d'ajout d'un compte bancaire
    public function create() {
        // Récupérer tous les clients pour la sélection dans le formulaire
        $clients = $this->compteModel->getAllClients(); 

        // Vérifie si le formulaire est soumis
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!empty($_POST['rib']) && !empty($_POST['solde']) && !empty($_POST['type_compte']) && !empty($_POST['id_client'])) {
                $rib = $_POST["rib"];
                $solde = $_POST["solde"];
                $type_compte = $_POST["type_compte"];
                $id_client = $_POST["id_client"];

                // Ajouter le compte en base de données
                if ($this->compteModel->addCompte($rib, $solde, $type_compte, $id_client)) {
                    header("Location: index.php?controller=compte&action=index&message=Compte ajouté avec succès.");
                    exit();
                } else {
                    $error = "❌ Une erreur est survenue lors de l'ajout du compte.";
                }
            } else {
                $error = "⚠️ Veuillez remplir tous les champs obligatoires.";
            }
        }

        // Afficher le formulaire d'ajout
        require __DIR__ . "/../views/comptes/ajouter.php";
    }

    // Affiche le formulaire de modification d'un compte 
    public function edit() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=compte&action=index&error=Compte introuvable.");
            exit();
        }

        // Récupérer le compte par son ID
        $id = $_GET['id'];
        $compte = $this->compteModel->getCompteWithClient($id);

        // Rediriger si le compte n'existe pas
        if (!$compte) {
            header("Location: index.php?controller=compte&action=index&error=Compte introuvable.");
            exit();
        }

        // Récupérer la liste des clients pour la sélection dans le formulaire
        $clients = $this->compteModel->getAllClients(); 

        // Afficher le formulaire de modification
        require __DIR__ . "/../views/comptes/modifier.php";
    }

    // Met à jour un compte bancaire
        public function update() {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                if (!empty($_POST["id"]) && !empty($_POST["solde"]) && !empty($_POST["type_compte"]) && !empty($_POST["id_client"])) {
                    $id = $_POST["id"];
                    $solde = $_POST["solde"];
                    $type_compte = $_POST["type_compte"];
                    $id_client = $_POST["id_client"];
                    
                    // Mettre à jour le compte en base de données
                    if ($this->compteModel->updateCompte($id, $solde, $type_compte, $id_client)) {
                        header("Location: index.php?controller=compte&action=index&message=Compte mis à jour avec succès.");
                        exit();
                    } else {
                        header("Location: index.php?controller=compte&action=edit&id=$id&error=Erreur lors de la mise à jour.");
                        exit();
                    }
                } else {
                    header("Location: index.php?controller=compte&action=edit&id=" . $_POST['id'] . "&error=Veuillez remplir tous les champs.");
                    exit();
                }
            }
        }

    // Supprime un compte bancaire
    public function delete() {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=compte&action=index&error=Compte introuvable.");
            exit();
        }

        // Supprimer le compte par son ID
        $id = $_GET['id'];
        // Supprimer le compte en base de données
        if ($this->compteModel->deleteCompte($id)) {
            header("Location: index.php?controller=compte&action=index&message=Compte supprimé avec succès.");
        } else {
            header("Location: index.php?controller=compte&action=index&error=Erreur lors de la suppression.");
        }
        exit();
    }
}

