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
    <title>Modifier un Compte</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Modifier un Compte Bancaire</h1>

    <form action="index.php?controller=compte&action=update" method="POST">
        <input type="hidden" name="id" value="<?= $compte['id'] ?>">

        <label for="rib">RIB :</label>
        <input type="text" id="rib" name="rib" value="<?= htmlspecialchars($compte['rib']) ?>" disabled>

        <label for="type_compte">Type de compte :</label>
        <select id="type_compte" name="type_compte">
            <option value="Courant" <?= $compte['type_compte'] == "Courant" ? "selected" : "" ?>>Courant</option>
            <option value="Épargne" <?= $compte['type_compte'] == "Épargne" ? "selected" : "" ?>>Épargne</option>
        </select>

        <label for="solde">Solde (€) :</label>
        <input type="number" id="solde" name="solde" value="<?= htmlspecialchars($compte['solde']) ?>" required>

        <button type="submit">Mettre à jour</button>
        <a href="index.php?controller=compte&action=index">Annuler</a>
    </form>
</body>
</html>
