
<!-- Inclure le header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center"> Ajouter un client</h2>

    <!-- Affichage des erreurs -->
    <?php if (isset($error)) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    
    <!-- Formulaire d'ajout d'un client -->
    <div class="card shadow-lg p-4">
        <form action="index.php?controller=client&action=create" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="telephone" class="form-label">Téléphone :</label>
                <input type="text" class="form-control" id="telephone" name="telephone" required>
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse :</label>
                <input type="text" class="form-control" id="adresse" name="adresse">
            </div>

            <!-- Boutons -->
            <div class="d-flex justify-content-between">
                <a href="index.php?controller=client&action=index" class="btn btn-secondary">Retour</a>
                <button type="submit" class="btn btn-primary"> Ajouter</button>
            </div>
        </form>
    </div>
</div>

<!-- Inclure footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
