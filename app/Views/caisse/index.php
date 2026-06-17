<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de Caisse · Supermarché</title>
    <link href="<?php echo base_url('bootstrap.min.css'); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url('bootstrap-icons.min.css'); ?>" />
    <link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>" />
  </head>
  <body>
    <div class="container" style="max-width: 1100px; margin-top: 50px;">
      <div class="card card-shadow p-4 p-xl-5">
        <div id="viewAccueil" class="view-section">
          <div class="text-center mb-4">
            <i class="bi bi-shop" style="font-size: 2.8rem; color: #0d6efd"></i>
            <h3 class="mt-3 fw-light" style="color: #1f2a3a">Caisse</h3>
            <p class="text-muted small">Sélectionnez à quelle caisse vous souhaitez accéder</p>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 col-12">
              <div class="p-4 bg-soft-primary rounded-4" style="background: #f2f7ff">
                
                <form id="formConnexion" action="<?php echo base_url('caisse/valider'); ?>" method="post">
                  <?= csrf_field() ?>
                  
                  <div class="mb-3">
                    <label for="selectCaisse" class="form-label fw-semibold">
                      <i class="bi bi-cash-register me-1"></i> Choisir la caisse
                    </label>
                    <select class="form-select" id="selectCaisse" name="id_caisse" required>
                      <option value="" disabled selected>-- Sélectionner une caisse --</option>
                      <?php foreach ($caisses as $caisse): ?>
                        <option value="<?= $caisse['id_caisse']; ?>">
                          <?= $caisse['nom_caisse']; ?>
                        </option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-valider" id="btnValiderConnexion">
                      <i class="bi bi-check-circle me-1"></i> Valider
                    </button>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>