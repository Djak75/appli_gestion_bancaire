<!-- Inclure le header -->
<?php require_once __DIR__ . '/../template/header.php'; ?>

<!-- Affichage Informations clients -->
<div class="container mt-5">
    <h2 class="text-center">📂 Dossier du Client</h2>
    <div class="card shadow-lg p-4">
        <h4>👤 Informations du Client</h4>
        <p><strong>Numéro Client :</strong> <?= htmlspecialchars($client['numero_client']) ?></p>
        <p><strong>Nom :</strong> <?= htmlspecialchars($client['nom']) ?></p>
        <p><strong>Prénom :</strong> <?= htmlspecialchars($client['prenom']) ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($client['email']) ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($client['telephone']) ?></p>
        <p><strong>Adresse :</strong> <?= htmlspecialchars($client['adresse'] ?? 'Non renseignée') ?></p>

        <h4>💳 Comptes Bancaires</h4>
        <!-- Recupérer les comptes des clients -->
        <?php if (!empty($comptes)) : ?>
            <ul>
                <?php foreach ($comptes as $compte) : ?>
                    <li>Identifiant de compte : <?= htmlspecialchars($compte['id']) ?> | Type : <?= htmlspecialchars($compte['type_compte']) ?> | Solde : <?= htmlspecialchars($compte['solde']) ?> €</li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucun compte bancaire associé.</p>
        <?php endif; ?>

        <h4>📜 Contrats Souscrits</h4>
        <?php if (!empty($contrats)) : ?>
            <ul>
                <?php foreach ($contrats as $contrat) : ?>
                    <li>Identifiant du contrat : <?= htmlspecialchars($contrat['id']) ?> | Type : <?= htmlspecialchars($contrat['type_contrat']) ?> | Montant : <?= htmlspecialchars($contrat['montant']) ?> € | Durée : <?= htmlspecialchars($contrat['duree']) ?> mois</li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>Aucun contrat souscrit.</p>
        <?php endif; ?>

        <div class="d-flex justify-content-between mt-4">
            <a href="index.php?controller=client&action=index" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>
</div>

<!-- Inclure footer -->
<?php require_once __DIR__ . '/../template/footer.php'; ?>
