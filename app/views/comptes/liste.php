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
    <h2 class="mb-4 text-center">💳  Liste des comptes bancaires</h2>

    <!-- Bouton Ajouter un Compte -->
    <div class="d-flex justify-content-end mb-3">
        <a href="index.php?controller=compte&action=create" class="btn btn-success">
            ➕ Ajouter un compte
        </a>
    </div>

    <!-- Tableau des comptes -->
    <?php if (!empty($comptes)): ?>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>RIB</th>
                    <th>Solde (€)</th>
                    <th>Type de compte</th>
                    <th>Client associé</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comptes as $compte): ?>
                    <tr>
                        <td><?= htmlspecialchars($compte['rib']) ?></td>
                        <td><?= htmlspecialchars($compte['solde']) ?> €</td>
                        <td><?= htmlspecialchars($compte['type_compte']) ?></td>
                        <td><?= htmlspecialchars($compte['nom'] . ' ' . $compte['prenom']) ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=compte&action=edit&id=<?= $compte['id'] ?>" class="btn btn-warning btn-sm">
                                Modifier
                            </a>
                            <a href="index.php?controller=compte&action=delete&id=<?= $compte['id'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('⚠️ Êtes-vous sûr de vouloir supprimer ce compte bancaire ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center mt-4">Aucun compte bancaire trouvé.</p>
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

<!-- Inclure footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
