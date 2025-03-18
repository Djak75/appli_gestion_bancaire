<?php
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
    <title>Ajouter un Client</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Ajouter un Client</h1>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?controller=client&action=create" method="POST">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" name="email" required>

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" required>

        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse">

        <button type="submit">Ajouter</button>
    </form>

    <a href="index.php?controller=client&action=index">Retour à la liste</a>
</body>
</html>
