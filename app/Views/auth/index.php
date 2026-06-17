<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestion de Caisse · Supermarché</title>
    <!-- Bootstrap 5 CDN + icônes -->
    <link
      href="bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="css/style.css"
    />
    
  </head>
  <body>
    <div class="container" style="max-width: 1100px">
      <div class="card card-shadow p-4 p-xl-5">
        <div id="viewAccueil" class="view-section">
          <div class="text-center mb-4">
            <i class="bi bi-shop" style="font-size: 2.8rem; color: #0d6efd"></i>
            <h3 class="mt-3 fw-light" style="color: #1f2a3a">
              Système de caisse
            </h3>
            <p class="text-muted small">
              Sélectionnez votre poste et connectez-vous
            </p>
          </div>

          <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 col-12">
              <div
                class="p-4 bg-soft-primary rounded-4"
                style="background: #f2f7ff"
              >
                <form id="formConnexion" onsubmit="return false;">
                  <!-- Select Caisse -->
                  <div class="mb-3">
                    <label for="selectCaisse" class="form-label fw-semibold"
                      ><i class="bi bi-cash-register me-1"></i> Choisir la
                      caisse</label
                    >
                    <select
                      class="form-select"
                      id="selectCaisse"
                      aria-label="Choix de la caisse"
                    >
                      <option selected value="centrale">
                        Caisse Centrale 01
                      </option>
                      <option value="rapide">Caisse Rapide 02</option>
                    </select>
                  </div>

                  <!-- Login / Password -->
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="loginInput" class="form-label fw-semibold"
                        ><i class="bi bi-person me-1"></i> Identifiant</label
                      >
                      <input
                        type="text"
                        class="form-control"
                        id="loginInput"
                        placeholder="ex: admin"
                        value="caissier1"
                      />
                    </div>
                    <div class="col-md-6">
                      <label for="passwordInput" class="form-label fw-semibold"
                        ><i class="bi bi-lock me-1"></i> Mot de passe</label
                      >
                      <input
                        type="password"
                        class="form-control"
                        id="passwordInput"
                        placeholder="••••••••"
                        value="123456"
                      />
                    </div>
                  </div>

                  <!-- Bouton valider -->
                  <div class="d-grid mt-4">
                    <button
                      type="button"
                      class="btn btn-valider"
                      id="btnValiderConnexion"
                    >
                      <i class="bi bi-check-circle me-1"></i> Valider
                    </button>
                  </div>
                  <p class="text-center text-muted small mt-3 mb-0">
                    <i class="bi bi-info-circle"></i> Démo : cliquer sur
                    "Valider" pour accéder à la vente
                  </p>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- ========== FIN SECTION 1 ========== -->
      </div>
      <!-- fin card -->
    </div>
    <!-- fin container -->

  </body>
</html>
