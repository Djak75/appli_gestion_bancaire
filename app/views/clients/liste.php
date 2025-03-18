<?php
// Vérifier si l'admin est connecté
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: index.php?controller=admin&action=loginForm");
    exit();
}
?>

<a href="index.php?controller=admin&action=logout">Déconnexion</a>

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
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Téléphone</th>
            <th>Adresse</th>
            <th>Actions</th> <!-- Nouvelle colonne pour Modifier et Supprimer -->
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client) : ?>
            <tr>
                <td><?= htmlspecialchars($client['nom']) ?></td>
                <td><?= htmlspecialchars($client['prenom']) ?></td>
                <td><?= htmlspecialchars($client['email']) ?></td>
                <td><?= htmlspecialchars($client['telephone']) ?></td>
                <td><?= htmlspecialchars($client['adresse']) ?></td>
                <td>
                    <a href="index.php?controller=client&action=edit&id=<?= $client['id'] ?>">Modifier</a> |
                    <a href="#" onclick="confirmDelete(<?= $client['id'] ?>, <?= $this->clientModel->hasAccounts($client['id']) ? 'true' : 'false' ?>)">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <!-- Script pour la double alerte -->
    <script>
    function confirmDelete(clientId, hasAccounts) {
        let message = hasAccounts ? 
            "ATTENTION : Ce client a un compte bancaire !\n" +
            "Êtes-vous sûr de vouloir définitivement supprimer ce client ?\n" +
            "Les comptes liés seront supprimés et irrécupérables !" :
            "Êtes-vous sûr de vouloir supprimer ce client ?";

        if (confirm(message)) {
            window.location.href = "index.php?controller=client&action=delete&id=" + clientId;
        }
    }
    </script>

    <!-- Affichage des messages sous le tableau -->
<?php if (isset($_GET['message'])) : ?>
    <p id="success-message" style="color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
<?php endif; ?>

<?php if (isset($_GET['error'])) : ?>
    <p id="error-message" style="color: red;"><?= htmlspecialchars($_GET['error']) ?></p>
<?php endif; ?>

<!-- Ajout d'un script pour faire disparaître le message après 3 secondes -->
<script>
    setTimeout(function() {
        let successMessage = document.getElementById("success-message");
        let errorMessage = document.getElementById("error-message");
        if (successMessage) successMessage.style.display = "none";
        if (errorMessage) errorMessage.style.display = "none";
    }, 3000); // 3 secondes
</script>

</body>
</html>
