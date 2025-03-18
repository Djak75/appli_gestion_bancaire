<?php
// Démarrer la session pour gérer l'authentification de l'administrateur
session_start();

// Inclure la connexion à la base de données
require_once __DIR__ . "/config/database.php";

// Récupérer le contrôleur et l'action depuis l'URL
$controller = $_GET['controller'] ?? 'admin'; // Par défaut : page de connexion admin
$action = $_GET['action'] ?? 'loginForm'; // Par défaut : formulaire de connexion

// Construire le chemin du fichier du contrôleur
$controllerFile = __DIR__ . "/app/controllers/" . ucfirst($controller) . "Controller.php";

// Vérifier si le fichier du contrôleur existe
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";

    // Instancier le contrôleur
    $controllerInstance = new $className();

    // Vérifier si l'action demandée existe dans le contrôleur
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        echo "❌ Erreur : Action '$action' introuvable.";
    }
} else {
    echo "❌ Erreur : Contrôleur '$controller' introuvable.";
}