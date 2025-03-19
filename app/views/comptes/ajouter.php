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
    <title>Ajouter un Compte</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Ajouter un Compte Bancaire</h1>

    <form action="index.php?controller=compte&action=store" method="POST">
        <label for="rib">RIB :</label>
        <input type="text" id="rib" name="rib" required>

        <label for="type_compte">Type de compte :</label>
        <select id="type_compte" name="type_compte" required>
            <option value="Courant">Courant</option>
            <option value="Épargne">Épargne</option>
        </select>

        <label for="solde">Solde initial (€) :</label>
        <input type="number" id="solde" name="solde" min="0" required>

        <label for="id_client">Client :</label>
        <select id="id_client" name="id_client" required>
            <?php foreach ($clients as $client) : ?>
                <option value="<?= $client['id'] ?>"><?= htmlspecialchars($client['nom'] . " " . $client['prenom']) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter le compte</button>
        <a href="index.php?controller=compte&action=index">Annuler</a>
    </form>
</body>
</html>