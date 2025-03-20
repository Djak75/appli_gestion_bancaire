<!-- Inclure le header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<!-- Affichage des messages de succès et d'erreur -->
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_GET['message']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($_GET['error']) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>


<div class="container mt-5">
    <h2 class="mb-4 text-center">👥 Liste des Clients</h2>

    <!-- Bouton Ajouter un Client -->
    <div class="d-flex justify-content-end mb-3">
        <a href="index.php?controller=client&action=create" class="btn btn-success">
            ➕ Ajouter un Client
        </a>

    </div>

    <!-- Tableau des clients -->
     <!-- Récupérer la liste des clients -->
    <?php if (!empty($clients)): ?>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $client): ?>
                    <tr>
                        <td><?= htmlspecialchars($client['nom']) ?></td>
                        <td><?= htmlspecialchars($client['prenom']) ?></td>
                        <td><?= htmlspecialchars($client['email']) ?></td>
                        <td><?= htmlspecialchars($client['telephone']) ?></td>
                        <td><?= htmlspecialchars($client['adresse']) ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=client&action=edit&id=<?= $client['id'] ?>" class="btn btn-warning btn-sm">
                                Modifier
                            </a>
                            <a href="#" 
                               class="btn btn-danger btn-sm"
                               onclick="confirmDelete(<?= $client['id'] ?>, <?= $this->clientModel->hasAccounts($client['id']) ? 'true' : 'false' ?>)">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center mt-4">Aucun client trouvé.</p>
    <?php endif; ?>
</div>

<!-- Script pour la double alerte de suppression -->
<script>
function confirmDelete(clientId, hasAccounts) {
    let message = hasAccounts ? 
        "⚠️ ATTENTION : Ce client a un compte bancaire !\n" +
        "Êtes-vous sûr de vouloir définitivement supprimer ce client ?\n" +
        "Les comptes liés seront supprimés et irrécupérables !" :
        "Êtes-vous sûr de vouloir supprimer ce client ?";

    if (confirm(message)) {
        window.location.href = "index.php?controller=client&action=delete&id=" + clientId;
    }
}
</script>

<!-- Supprimer au bout 3 secondes -->
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll(".alert");
        alerts.forEach(alert => {
            alert.style.display = "none";
        });
    }, 3000); // 3 secondes
</script>

<!-- Inclure footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>