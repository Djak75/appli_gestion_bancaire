<?php
// Vérifier si l'administrateur est connecté
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?controller=admin&action=loginForm");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Banque</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="/Simplon/appli_gestion_bancaire/app/views/template/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>
<body>

<!-- Barre de navigation principale -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php?controller=dashboard">🏦 Banque Gestion</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=dashboard">📊 Tableau de bord</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=client&action=index">👥 Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=compte&action=index">💳 Comptes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=contrat&action=index">📜 Contrats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white ms-3" href="index.php?controller=admin&action=logout">🔐 Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Affichage du nom de l'administrateur connecté -->
<?php if (isset($_SESSION['admin'])) : ?>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <span class="navbar-text">
                Bonjour, <strong>Admin</strong> 👋
            </span>
        </div>
    </nav>
<?php endif; ?>


