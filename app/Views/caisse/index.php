<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de Caisse · Supermarché</title>
    <link href="<?= base_url('bootstrap.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/caisse.css') ?>" />
</head>
<body>
    <div class="caisse-page">
        <div class="caisse-container">
            <div class="caisse-card">
                <!-- En-tête -->
                <div class="caisse-header">
                    <div class="caisse-icon">
                            <img src="<?= base_url('img/caisse.png') ?>" alt="Caisse" style="width: 45px; height: 45px; object-fit: contain;">
                    </div>
                    <h1 class="caisse-title">Choix de la caisse</h1>
                    <p class="caisse-subtitle">
                        Sélectionnez la caisse à laquelle vous souhaitez accéder
                    </p>
                </div>

                <!-- Zone de sélection -->
                <div class="caisse-selector">
                    <form id="formConnexion" action="<?= base_url('caisse/valider') ?>" method="post">
                        <?= csrf_field() ?>

                        <label class="form-label" for="selectCaisse">
                            <i class="bi bi-cash-register"></i> Caisse
                        </label>
                        <select 
                            class="form-select-caisse" 
                            id="selectCaisse" 
                            name="id_caisse" 
                            required
                        >
                            <option value="" disabled selected>-- Sélectionner une caisse --</option>
                            <?php foreach ($caisses as $caisse): ?>
                                <option value="<?= $caisse['id_caisse'] ?>">
                                    <?= $caisse['nom_caisse'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <button type="submit" class="btn-caisse" id="btnValiderConnexion">
                            <i class="bi bi-check-circle"></i>
                            Valider
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('js/caisse.js') ?>"></script>
</body>
</html>