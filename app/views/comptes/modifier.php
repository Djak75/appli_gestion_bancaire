<!-- Inclure le header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">Modifier un compte bancaire</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulaire de modification -->
    <div class="card shadow-lg p-4">
         <form action="index.php?controller=compte&action=update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($compte['id']) ?>">

            <div class="mb-3">
                <label for="rib" class="form-label">RIB :</label>
                <input type="text" class="form-control" id="rib" name="rib" value="<?= htmlspecialchars($compte['rib']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="type_compte" class="form-label">Type de compte :</label>
                <select class="form-control" id="type_compte" name="type_compte" required>
                    <option value="Courant" <?= ($compte['type_compte'] == 'Courant') ? 'selected' : '' ?>>Compte Courant</option>
                    <option value="Épargne" <?= ($compte['type_compte'] == 'Épargne') ? 'selected' : '' ?>>Compte Épargne</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="solde" class="form-label">Solde (€) :</label>
                <input type="number" class="form-control" id="solde" name="solde" value="<?= htmlspecialchars($compte['solde']) ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Client Associé :</label>
                <input type="text" class="form-control" 
                    value="<?= htmlspecialchars($compte['client_nom'] . ' ' . $compte['client_prenom']) ?>" 
                    readonly>
                <input type="hidden" name="id_client" value="<?= $compte['id_client'] ?>">
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=compte&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-success">Mettre à jour</button>
            </div>
        </form>
    </div>
</div>

<!-- Inclure le footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
