<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Ventes</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('bootstrap-icons.min.css') ?>">
</head>
<body>
    <div class="container pt-4">
        <div id="viewVente" class="view-section" style="display: block;">
          
          <div class="header-caisse d-flex flex-wrap align-items-center justify-content-between pb-3 border-bottom">
            <div>
              <span class="badge-caisse">
                <i class="bi bi-cash-stack me-2"></i> Caisse active :
                <span id="caisseActiveLabel"><?= session()->get('nom_caisse') ?? 'Inconnue' ?></span>
              </span>
            </div>
            <div class="d-flex align-items-center gap-2">
              <i class="bi bi-person-circle fs-5" style="color: #2a4058"></i>
              <span class="fw-semibold" id="userConnectedLabel"><?= session()->get('nom_utilisateur') ?? 'Inconnu' ?></span>
              <span class="text-muted small ms-1">· connecté</span>
            </div>
          </div>

          <div class="px-3 pt-4 pb-2">
            <div class="row g-3 align-items-end">
              <div class="col-md-5">
                <label for="selectProduit" class="form-label fw-semibold">
                  <i class="bi bi-tag me-1"></i> Produit
                </label>
                <select class="form-select" id="selectProduit">
                  <?php foreach ($produits as $produit) : ?>
                    <option value="<?= $produit['id_produit'] ?>" data-prix="<?= $produit['prix_unitaire'] ?>">
                      <?= $produit['designation'] ?> - <?= number_format($produit['prix_unitaire'], 2, ',', ' ') ?> €
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-3">
                <label for="quantiteInput" class="form-label fw-semibold">
                  <i class="bi bi-hash me-1"></i> Quantité
                </label>
                <input
                  type="number"
                  class="form-control"
                  id="quantiteInput"
                  value="1"
                  min="1"
                  step="1"
                />
              </div>
              <div class="col-md-4">
                <button
                  class="btn btn-primary rounded-pill px-4 w-100"
                  id="btnAjouterPanier"
                >
                  <i class="bi bi-plus-circle me-1"></i> Ajouter
                </button>
              </div>
            </div>
          </div>

          <div class="px-3 mt-3">
            <div class="table-responsive">
              <table class="table table-hover table-striped align-middle" id="tablePanier">
                <thead>
                  <tr>
                    <th>ID</th> <th>Produit</th>
                    <th>P.U.</th>
                    <th>Qté</th>
                    <th>Montant</th>
                  </tr>
                </thead>
                <tbody id="panierBody">
                  </tbody>
                <tfoot>
                  <tr>
                    <td colspan="4" class="text-end fw-bold">Total TTC</td>
                    <td class="total-amount" id="totalPanier">0,00 €</td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

          <div class="footer-panel d-flex flex-wrap align-items-center justify-content-between mt-4 pt-3 border-top">
            <div>
              <span class="text-muted small">
                <i class="bi bi-credit-card"></i> Paiement accepté : CB / Espèces
              </span>
            </div>
            <div>
              <button class="btn btn-cloturer btn-success rounded-pill px-4" id="btnCloturerAchat">
                <i class="bi bi-cart-check me-2"></i> Clôturer l'achat
              </button>
            </div>
          </div>
          
          <p class="text-muted small text-center mt-3 mb-0">
            <i class="bi bi-arrow-up-circle"></i> Ajoutez des produits ou cliquez sur "Clôturer" (simulation)
          </p>
        </div>
    </div>

    <script src="<?= base_url('bootstrap.bundle.min.js') ?>"></script>
    
    <script>
      // Clôturer achat et récupérer les données
// Clôturer achat et envoyer vers le contrôleur PHP
document.getElementById("btnCloturerAchat").addEventListener("click", function () {
    const rows = panierBody.querySelectorAll("tr");
    
    if (rows.length === 0) {
      alert("Le panier est vide. Ajoutez des produits avant de clôturer.");
      return;
    }

    let panierDonnees = [];

    // Parcourir le tableau HTML pour structurer le JSON
    rows.forEach((row) => {
        const idProduit = row.cells[0].textContent.replace('#', '').trim();
        const prixUnitaire = parseFloat(row.cells[2].textContent.replace(',', '.').replace(' €', '').trim());
        const quantite = parseInt(row.cells[3].textContent.trim(), 10);

        panierDonnees.push({
            id_produit: idProduit,
            quantite_achetee: quantite,
            prix_unitaire: prixUnitaire
        });
    });

    // Envoi des données vers le contrôleur CodeIgniter 4
    fetch('<?= base_url("vente/enregistrer") ?>', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
            produits: panierDonnees
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(`🧾 Achat validé en BDD !\nTicket N° : ${data.num_ticket}`);
            
            // On vide le tableau HTML et remet le total à 0
            panierBody.innerHTML = "";
            totalSpan.textContent = "0,00 €";
        } else {
            alert("Erreur système : " + data.message);
        }
    })
    .catch(error => {
        console.error("Erreur AJAX :", error);
        alert("Impossible de joindre le serveur.");
    });
});
      (function () {
        const selectProduit = document.getElementById("selectProduit");
        const quantiteInput = document.getElementById("quantiteInput");
        const btnAjouter = document.getElementById("btnAjouterPanier");
        const panierBody = document.getElementById("panierBody");
        const totalSpan = document.getElementById("totalPanier");

        // ---------- GESTION PANIER ----------
        function calculerTotal() {
          let total = 0;
          const rows = panierBody.querySelectorAll("tr");
          rows.forEach((row) => {
            // Le montant est désormais dans la 5ème cellule (index 4) à cause de l'ID
            const cellMontant = row.cells[4];
            if (cellMontant) {
              const montantStr = cellMontant.textContent
                .replace(",", ".")
                .replace(" €", "")
                .trim();
              const val = parseFloat(montantStr);
              if (!isNaN(val)) total += val;
            }
          });
          totalSpan.textContent = total.toFixed(2).replace(".", ",") + " €";
        }

        // Ajouter une ligne au panier (incluant l'idProduit)
        function ajouterLigne(idProduit, produitNom, prixUnit, quantite) {
          const montant = prixUnit * quantite;
          const prixFormate = prixUnit.toFixed(2).replace(".", ",") + " €";
          const montantFormate = montant.toFixed(2).replace(".", ",") + " €";

          const tr = document.createElement("tr");
          tr.innerHTML = `
          <td class="text-muted">#${idProduit}</td>
          <td><i class="bi bi-basket text-secondary me-2"></i> ${produitNom}</td>
          <td>${prixFormate}</td>
          <td>${quantite}</td>
          <td class="fw-semibold">${montantFormate}</td>
        `;
          panierBody.appendChild(tr);
          calculerTotal();
        }

        // Gestion du clic "Ajouter"
        btnAjouter.addEventListener("click", function () {
          const selectedOption = selectProduit.options[selectProduit.selectedIndex];
          if (!selectedOption) return;

          // Récupération des informations nécessaires
          const idProduit = selectedOption.value;
          const produitNom = selectedOption.text.split(" - ")[0];
          const prixUnit = parseFloat(selectedOption.dataset.prix);
          let quantite = parseInt(quantiteInput.value, 10);
          
          if (isNaN(quantite) || quantite < 1) quantite = 1;

          // Envoi de l'ID à la fonction d'ajout
          ajouterLigne(idProduit, produitNom, prixUnit, quantite);
          quantiteInput.value = 1;
        });

        // ❌ SUPPRIMEZ CE BLOC QUI FAIT CONFLIT AVEC LE VRAI ENREGISTREMENT FETCH ❌
        /*
        document.getElementById("btnCloturerAchat").addEventListener("click", function () {
            const total = totalSpan.textContent;
            if (panierBody.children.length === 0) {
              alert("Le panier est vide. Ajoutez des produits avant de clôturer.");
              return;
            }
            alert(`🧾 Achat clôturé ! Total : ${total} \n(Simulation - Merci pour votre achat)`);
            panierBody.innerHTML = "";
            totalSpan.textContent = "0,00 €";
        });
        */

        // Initialisation du total au démarrage (affichera 0,00 € au début)
        calculerTotal();

        // Raccourci touche "Entrée" sur la quantité
        quantiteInput.addEventListener("keypress", function (e) {
          if (e.key === "Enter") {
            e.preventDefault();
            btnAjouter.click();
          }
        });
      })();
    </script>
</body>
</html>