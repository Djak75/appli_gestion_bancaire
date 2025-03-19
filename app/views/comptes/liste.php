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
    <title>Liste des Comptes Bancaires</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Liste des Comptes Bancaires</h1>

    <a href="index.php?controller=admin&action=logout">Déconnexion</a>
    <table border="1">
        <thead>
            <tr>
                <th>RIB</th>
                <th>Type</th>
                <th>Solde (€)</th>
                <th>Client</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comptes as $compte) : ?>
                <tr>
                    <td><?= htmlspecialchars($compte['rib']) ?></td>
                    <td><?= htmlspecialchars($compte['type_compte']) ?></td>
                    <td><?= htmlspecialchars(number_format($compte['solde'], 2, ',', ' ')) ?> €</td>
                    <td><?= htmlspecialchars($compte['nom']) . " " . htmlspecialchars($compte['prenom']) ?></td>
                    <td>
                        <a href="index.php?controller=compte&action=edit&id=<?= $compte['id'] ?>">Modifier</a> |
                        <a href="#" onclick="confirmDelete(<?= $compte['id'] ?>)">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?controller=compte&action=create">Ajouter un Compte</a>

    <script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce compte ?")) {
            window.location.href = "index.php?controller=compte&action=delete&id=" + id;
        }
    }
    </script>
</body>
</html>
