<!-- Inclure header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">➕ Ajouter un Compte Bancaire</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Formulaire d'ajout d'un compte -->
    <div class="card shadow-lg p-4">
        <form action="index.php?controller=compte&action=create" method="POST">
            <div class="mb-3">
                <label for="rib" class="form-label">RIB :</label>
                <input type="text" class="form-control" id="rib" name="rib" required>
            </div>

            <div class="mb-3">
                <label for="solde" class="form-label">Solde (€) :</label>
                <input type="number" class="form-control" id="solde" name="solde" step="0.01" required>
            </div>

            <div class="mb-3">
                <label for="type_compte" class="form-label">Type de Compte :</label>
                <select class="form-control" id="type_compte" name="type_compte" required>
                    <option value="Courant">Compte Courant</option>
                    <option value="Épargne">Compte Épargne</option>
                </select>
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
                <a href="index.php?controller=compte&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Inclure footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
