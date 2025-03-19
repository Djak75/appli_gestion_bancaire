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
    <title>Ajouter un Contrat</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Ajouter un Contrat</h1>

    <form action="index.php?controller=contrat&action=store" method="POST">
        <label for="type_contrat">Type de contrat :</label>
        <select id="type_contrat" name="type_contrat" required>
            <option value="Assurance Vie">Assurance Vie</option>
            <option value="Assurance Habitation">Assurance Habitation</option>
            <option value="Crédit Immobilier">Crédit Immobilier</option>
            <option value="Crédit à la Consommation">Crédit à la Consommation</option>
            <option value="CEL">Compte Épargne Logement (CEL)</option>
        </select>

        <label for="montant">Montant souscrit (€) :</label>
        <input type="number" id="montant" name="montant" min="0" required>

        <label for="duree">Durée (mois) :</label>
        <input type="number" id="duree" name="duree" min="1" required>

        <label for="id_client">Client :</label>
        <select id="id_client" name="id_client" required>
            <?php foreach ($clients as $client) : ?>
                <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['nom'] . " " . $client['prenom']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter le contrat</button>
        <a href="index.php?controller=contrat&action=index">Annuler</a>
    </form>
</body>
</html>
