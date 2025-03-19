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
    <title>Liste des Contrats</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Liste des Contrats</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Type</th>
                <th>Montant (€)</th>
                <th>Durée (mois)</th>
                <th>Client</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contrats as $contrat) : ?>
                <tr>
                    <td><?= htmlspecialchars($contrat['type_contrat']) ?></td>
                    <td><?= htmlspecialchars(number_format($contrat['montant'], 2, ',', ' ')) ?> €</td>
                    <td><?= htmlspecialchars($contrat['duree']) ?> mois</td>
                    <td><?= htmlspecialchars($contrat['nom']) . " " . htmlspecialchars($contrat['prenom']) ?></td>
                    <td>
                        <a href="index.php?controller=contrat&action=edit&id=<?= $contrat['id'] ?>">Modifier</a> |
                        <a href="#" onclick="confirmDelete(<?= $contrat['id'] ?>)">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?controller=contrat&action=create">Ajouter un Contrat</a>

    <script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce contrat ? Cette action est irréversible.")) {
            window.location.href = "index.php?controller=contrat&action=delete&id=" + id;
        }
    }
    </script>
</body>
</html>
