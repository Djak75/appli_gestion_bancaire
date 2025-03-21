<?php require_once __DIR__ . '/template/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center">📊 Tableau de bord</h2>
    <br><br><br>
    <div class="row text-center mt-4">
        <!-- Carte Clients -->
        <div class="col-md-4">
            <a href="index.php?controller=client&action=index" class="text-decoration-none">
                <div class="card text-white bg-primary mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">👤 Clients enregistrés</h5>
                        <p class="card-text fs-1"><?= $totalClients ?></p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Carte Comptes -->
        <div class="col-md-4">
            <a href="index.php?controller=compte&action=index" class="text-decoration-none">
                <div class="card text-white bg-success mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">💳 Comptes ouverts</h5>
                        <p class="card-text fs-1"><?= $totalComptes ?></p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Carte Contrats -->
        <div class="col-md-4">
            <a href="index.php?controller=contrat&action=index" class="text-decoration-none">
                <div class="card text-white bg-warning mb-3 shadow-lg">
                    <div class="card-body">
                        <h5 class="card-title">📜 Contrats souscrits</h5>
                        <p class="card-text fs-1"><?= $totalContrats ?></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/template/footer.php'; ?>
