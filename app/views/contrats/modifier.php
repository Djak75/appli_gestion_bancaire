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
    <title>Modifier un Contrat</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Modifier un Contrat</h1>

    <form action="index.php?controller=contrat&action=update" method="POST">
        <input type="hidden" name="id" value="<?= $contrat['id'] ?>">

        <label for="type_contrat">Type de contrat :</label>
        <input type="text" id="type_contrat" name="type_contrat" value="<?= htmlspecialchars($contrat['type_contrat']) ?>" disabled>

        <label for="montant">Montant souscrit (€) :</label>
        <input type="number" id="montant" name="montant" value="<?= htmlspecialchars($contrat['montant']) ?>" min="0" required>

        <label for="duree">Durée (mois) :</label>
        <input type="number" id="duree" name="duree" value="<?= htmlspecialchars($contrat['duree']) ?>" min="1" required>

        <button type="submit">Mettre à jour</button>
        <a href="index.php?controller=contrat&action=index">Annuler</a>
    </form>
</body>
</html>
