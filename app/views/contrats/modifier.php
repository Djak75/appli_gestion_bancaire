<!-- Inclure le header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">✏️ Modifier un Contrat</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulaire de modification -->
    <div class="card shadow-lg p-4">
        <form action="index.php?controller=contrat&action=update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($contrat['id']) ?>">

            <div class="mb-3">
                <label for="type_contrat" class="form-label">Type de Contrat :</label>
                <select class="form-control" id="type_contrat" name="type_contrat" required>
                    <?php
                    $types = ["Assurance Vie", "Assurance Habitation", "Crédit Immobilier", "Crédit à la Consommation", "CEL"];
                    foreach ($types as $type) :
                    ?>
                        <option value="<?= $type ?>" <?= ($contrat['type_contrat'] == $type) ? 'selected' : '' ?>>
                            <?= $type ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="montant" class="form-label">Montant (€) :</label>
                <input type="number" class="form-control" id="montant" name="montant" value="<?= htmlspecialchars($contrat['montant']) ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="duree" class="form-label">Durée (mois) :</label>
                <input type="number" class="form-control" id="duree" name="duree" value="<?= htmlspecialchars($contrat['duree']) ?>" required>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=contrat&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-success">Mettre à Jour</button>
            </div>
        </form>
    </div>
</div>

<!-- Inclure le footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
