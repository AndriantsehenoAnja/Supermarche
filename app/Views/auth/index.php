<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Connexion · Supermarché</title>
    <link href="<?= base_url('bootstrap.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('css/auth.css') ?>" />
</head>
<body>
    <div class="auth-wrapper">
        <div class="auth-card">
            <!-- Icône -->
            <div class="auth-icon">
                    <img src="<?= base_url('img/caisse.png') ?>" alt="Connexion" style="width: 50px; height: 50px; object-fit: contain;">
            </div>

            <h1 class="auth-title">Bienvenue</h1>
            <p class="auth-subtitle">Connectez-vous à votre espace</p>

            <?php if (session()->getFlashdata('erreur')): ?>
                <div class="auth-alert auth-alert-danger">
                    <i class="bi bi-exclamation-circle"></i>
                    <?= session()->getFlashdata('erreur') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/connexion') ?>" method="post" autocomplete="off">
                <?= csrf_field() ?>

                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-person"></i> Identifiant
                    </label>
                    <input 
                        type="text" 
                        name="username" 
                        class="form-control" 
                        placeholder="Entrez votre identifiant"
                        value="caissier1"
                        required
                        autofocus
                    >
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="bi bi-lock"></i> Mot de passe
                    </label>
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control" 
                        placeholder="Entrez votre mot de passe"
                        value="password123"
                        required
                    >
                </div>

                <button type="submit" class="btn-auth">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Se connecter
                </button>
            </form>
        </div>
    </div>

    <script src="<?= base_url('js/auth.js') ?>"></script>
</body>
</html>