<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Ajouter un Contrat</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg p-4">
        <form action="index.php?controller=contrat&action=create" method="POST">
            <div class="mb-3">
                <label for="type_contrat" class="form-label">Type de Contrat :</label>
                <select class="form-control" id="type_contrat" name="type_contrat" required>
                    <option value="Assurance Vie">Assurance Vie</option>
                    <option value="Assurance Habitation">Assurance Habitation</option>
                    <option value="Crédit Immobilier">Crédit Immobilier</option>
                    <option value="Crédit à la Consommation">Crédit à la Consommation</option>
                    <option value="CEL">Compte Épargne Logement (CEL)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="montant" class="form-label">Montant (€) :</label>
                <input type="number" class="form-control" id="montant" name="montant" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="duree" class="form-label">Durée (mois) :</label>
                <input type="number" class="form-control" id="duree" name="duree" required>
            </div>

            <div class="mb-3">
                <label for="id_client" class="form-label">Client Associé :</label>
                <select class="form-control" id="id_client" name="id_client" required>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?= $client['id'] ?>">
                            <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=contrat&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../template/footer.php'; ?>

