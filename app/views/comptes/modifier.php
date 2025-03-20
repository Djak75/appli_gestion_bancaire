<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">✏️ Modifier un Compte Bancaire</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg p-4">
         <form action="index.php?controller=compte&action=update" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($compte['id']) ?>">

            <div class="mb-3">
                <label for="rib" class="form-label">RIB :</label>
                <input type="text" class="form-control" id="rib" name="rib" value="<?= htmlspecialchars($compte['rib']) ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="solde" class="form-label">Solde (€) :</label>
                <input type="number" class="form-control" id="solde" name="solde" value="<?= htmlspecialchars($compte['solde']) ?>" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="type_compte" class="form-label">Type de Compte :</label>
                <select class="form-control" id="type_compte" name="type_compte" required>
                    <option value="Courant" <?= ($compte['type_compte'] == 'Courant') ? 'selected' : '' ?>>Compte Courant</option>
                    <option value="Épargne" <?= ($compte['type_compte'] == 'Épargne') ? 'selected' : '' ?>>Compte Épargne</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_client" class="form-label">Client Associé :</label>
                <select class="form-control" id="id_client" name="id_client" required>
                    <?php foreach ($clients as $client) : ?>
                        <option value="<?= $client['id'] ?>" <?= ($compte['id_client'] == $client['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($client['nom'] . ' ' . $client['prenom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=compte&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-success">Mettre à Jour</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../template/footer.php'; ?>
