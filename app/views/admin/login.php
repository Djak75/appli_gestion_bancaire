<?php
// Démarrer la session pour afficher les messages d'erreur
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Administrateur</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="app/views/template/style.css">
</head>
<body>

<!-- Barre de navigation principale -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">🏦 Banque Gestion</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=client&action=index">👥 Clients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=compte&action=index">💰 Comptes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?controller=contrat&action=index">📜 Contrats</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-danger btn-sm text-white ms-3" href="index.php?controller=admin&action=logout">🔓 Connexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h2 class="text-center"> Connexion </h2>

        <!-- Affichage des erreurs de connexion -->
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_SESSION['error_message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error_message']); ?>
        <?php endif; ?>

        <form action="index.php?controller=admin&action=login" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">📧 Adresse e-mail :</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">🔑 Mot de passe :</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Se connecter</button>
        </form>
    </div>

</div>

<?php require_once __DIR__ . '/../template/footer.php'; ?>