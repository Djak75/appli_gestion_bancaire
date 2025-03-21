<?php
// Message d'erreur
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// Démarrer la session pour gérer l'authentification de l'administrateur
session_start();

// Inclure la connexion à la base de données
require_once __DIR__ . "/config/database.php";

// Créer la connexion à la base de données
$db = (new Database())->getConnection();

// Récupérer le contrôleur et l'action depuis l'URL
$controller = $_GET['controller'] ?? 'dashboard'; // Par défaut : page de connexion admin
$action = $_GET['action'] ?? 'index'; // Par défaut : formulaire de connexion

// Construire le chemin du fichier du contrôleur
$controllerFile = __DIR__ . "/app/controllers/" . ucfirst($controller) . "Controller.php";

// Vérifier si le fichier du contrôleur existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";

    // Instancier le contrôleur avec `$db` si nécessaire
    if (class_exists($className)) {
        if (in_array($className, ["CompteController", "ClientController", "ContratController"])) {
            $controllerInstance = new $className($db); // On passe `$db` aux contrôleurs qui en ont besoin
        } else {
            $controllerInstance = new $className(); // Pour les autres contrôleurs
        }

        // Vérifier si l'action demandée existe dans le contrôleur
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            echo "Erreur : Action '$action' introuvable.";
        }
    } else {
        echo "Erreur : Classe du contrôleur '$className' introuvable.";
    }
} else {
    echo "Erreur : Contrôleur '$controller' introuvable.";
}