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
    <h2 class="mb-4 text-center">📜 Liste des Contrats</h2>

    <!-- Bouton Ajouter un Contrat -->
    <div class="d-flex justify-content-end mb-3">
        <a href="index.php?controller=contrat&action=create" class="btn btn-success">
            ➕ Ajouter un Contrat
        </a>
    </div>

    <!-- Tableau des contrats -->
    <?php if (!empty($contrats)): ?>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Type</th>
                    <th>Montant (€)</th>
                    <th>Durée (mois)</th>
                    <th>Client Associé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contrats as $contrat): ?>
                    <tr>
                        <td><?= htmlspecialchars($contrat['type_contrat']) ?></td>
                        <td><?= htmlspecialchars($contrat['montant']) ?> €</td>
                        <td><?= htmlspecialchars($contrat['duree']) ?> mois</td>
                        <td><?= htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']) ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=contrat&action=edit&id=<?= $contrat['id'] ?>" class="btn btn-warning btn-sm">
                                Modifier
                            </a>
                            <a href="index.php?controller=contrat&action=delete&id=<?= $contrat['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer ce contrat ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center mt-4">Aucun contrat trouvé.</p>
    <?php endif; ?>
</div>

<!-- Supprimer au bout 3 secondes -->
<script>
    setTimeout(() => {
        let alerts = document.querySelectorAll(".alert");
        alerts.forEach(alert => {
            alert.style.display = "none";
        });
    }, 3000); // 3 secondes
</script>

<!-- Inclure le footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
