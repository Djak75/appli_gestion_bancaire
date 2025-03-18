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
    <link rel="stylesheet" href="../views/template/style.css">
</head>
<body>
    <h1>Connexion Administrateur</h1>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?controller=admin&action=login" method="POST">
        <label for="email">Email :</label>
        <input type="email" name="email" required>
        
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" required>
        
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>