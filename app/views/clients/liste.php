<?php
// Vérifier si l'admin est connecté
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
    <title>Liste des Clients</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Liste des Clients</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clients as $client) : ?>
                <tr>
                    <td><?= htmlspecialchars($client['id']) ?></td>
                    <td><?= htmlspecialchars($client['nom']) ?></td>
                    <td><?= htmlspecialchars($client['prenom']) ?></td>
                    <td><?= htmlspecialchars($client['email']) ?></td>
                    <td><?= htmlspecialchars($client['telephone']) ?></td>
                    <td><?= htmlspecialchars($client['adresse']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?controller=admin&action=logout">Déconnexion</a>
</body>
</html>
