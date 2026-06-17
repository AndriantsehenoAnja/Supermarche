<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Connexion · Supermarché</title>
    <link href="<?= base_url('bootstrap.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons.min.css') ?>" />
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4 shadow" style="width: 400px; border-radius: 15px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #0d6efd"></i>
                <h3 class="mt-2 fw-light">Authentification</h3>
            </div>

            <?php if (session()->getFlashdata('erreur')): ?>
                <div class="alert alert-danger py-2 small text-center"><?= session()->getFlashdata('erreur') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('auth/connexion') ?>" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><i class="bi bi-user"></i> Identifiant</label>
                    <input type="text" name="username" class="form-control" placeholder="Ex: caissier1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold"><i class="bi bi-lock"></i> Mot de passe</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>