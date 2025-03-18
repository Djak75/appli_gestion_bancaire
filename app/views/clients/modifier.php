<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
    <link rel="stylesheet" href="views/template/style.css">
</head>
<body>
    <h1>Modifier un Client</h1>

    <?php if (!empty($error)) : ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="index.php?controller=client&action=edit&id=<?= $client['id'] ?>" method="POST">
        <input type="text" name="nom" value="<?= $client['nom'] ?>" required>
        <input type="text" name="prenom" value="<?= $client['prenom'] ?>" required>
        <input type="email" name="email" value="<?= $client['email'] ?>" required>
        <input type="text" name="telephone" value="<?= $client['telephone'] ?>" required>
        <input type="text" name="adresse" value="<?= $client['adresse'] ?>">

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
