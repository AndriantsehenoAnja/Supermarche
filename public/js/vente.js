// assets/js/vente.js

document.addEventListener('DOMContentLoaded', function() {
    const selectProduit = document.getElementById('selectProduit');
    const quantiteInput = document.getElementById('quantiteInput');
    const btnAjouter = document.getElementById('btnAjouterPanier');
    const panierBody = document.getElementById('panierBody');
    const totalSpan = document.getElementById('totalPanier');
    const btnCloturer = document.getElementById('btnCloturerAchat');
    const emptyRow = document.getElementById('emptyRow');

    let panier = [];

    // ---------- Calcul du total ----------
    function calculerTotal() {
        let total = 0;
        const rows = panierBody.querySelectorAll('tr:not(#emptyRow)');
        rows.forEach((row) => {
            const cellMontant = row.querySelector('.product-total');
            if (cellMontant) {
                const montantStr = cellMontant.textContent
                    .replace(',', '.')
                    .replace(' €', '')
                    .trim();
                const val = parseFloat(montantStr);
                if (!isNaN(val)) total += val;
            }
        });
        totalSpan.textContent = total.toFixed(2).replace('.', ',') + ' €';
        return total;
    }

    // ---------- Afficher/masquer le message vide ----------
    function toggleEmptyMessage() {
        const rows = panierBody.querySelectorAll('tr:not(#emptyRow)');
        if (rows.length === 0) {
            if (!document.getElementById('emptyRow')) {
                const tr = document.createElement('tr');
                tr.id = 'emptyRow';
                tr.innerHTML = `
                    <td colspan="5">
                        <div class="empty-cart-message">
                            <i class="bi bi-cart"></i>
                            <p>Le panier est vide<br><small>Ajoutez des produits ci-dessus</small></p>
                        </div>
                    </td>
                `;
                panierBody.appendChild(tr);
            }
        } else {
            const empty = document.getElementById('emptyRow');
            if (empty) empty.remove();
        }
    }

    // ---------- Ajouter une ligne au panier ----------
    function ajouterLigne(idProduit, produitNom, prixUnit, quantite) {
        const montant = prixUnit * quantite;
        const prixFormate = prixUnit.toFixed(2).replace('.', ',') + ' €';
        const montantFormate = montant.toFixed(2).replace('.', ',') + ' €';

        // Vérifier si le produit existe déjà
        const existingRow = panierBody.querySelector(`tr[data-id="${idProduit}"]`);
        
        if (existingRow) {
            // Incrémenter la quantité
            const qtyCell = existingRow.querySelector('.product-qty');
            const totalCell = existingRow.querySelector('.product-total');
            let currentQty = parseInt(qtyCell.textContent);
            let newQty = currentQty + quantite;
            let newTotal = prixUnit * newQty;
            
            qtyCell.textContent = newQty;
            totalCell.textContent = newTotal.toFixed(2).replace('.', ',') + ' €';
            
            // Mettre à jour le panier en mémoire
            const item = panier.find(p => p.id === idProduit);
            if (item) {
                item.quantite = newQty;
                item.montant = newTotal;
            }
        } else {
            // Créer une nouvelle ligne
            const tr = document.createElement('tr');
            tr.setAttribute('data-id', idProduit);
            tr.innerHTML = `
                <td class="product-name">
                    <i class="bi bi-basket text-secondary me-2"></i>
                    ${produitNom}
                </td>
                <td class="product-price">${prixFormate}</td>
                <td class="product-qty">${quantite}</td>
                <td class="product-total fw-bold">${montantFormate}</td>
                <td>
                    <button class="btn-remove-product" data-id="${idProduit}" title="Supprimer">
                        <i class="bi bi-x-circle"></i>
                    </button>
                </td>
            `;
            panierBody.appendChild(tr);

            // Ajouter au panier mémoire
            panier.push({
                id: idProduit,
                nom: produitNom,
                prix: prixUnit,
                quantite: quantite,
                montant: montant
            });

            // Événement de suppression
            tr.querySelector('.btn-remove-product').addEventListener('click', function() {
                const id = this.dataset.id;
                supprimerLigne(id);
            });
        }

        toggleEmptyMessage();
        calculerTotal();
        updateCloturerButton();
    }

    // ---------- Supprimer une ligne ----------
    function supprimerLigne(idProduit) {
        const row = panierBody.querySelector(`tr[data-id="${idProduit}"]`);
        if (row) {
            row.style.animation = 'slideIn 0.3s ease-out reverse';
            setTimeout(() => {
                row.remove();
                panier = panier.filter(p => p.id !== idProduit);
                toggleEmptyMessage();
                calculerTotal();
                updateCloturerButton();
            }, 200);
        }
    }

    // ---------- Mettre à jour le bouton clôturer ----------
    function updateCloturerButton() {
        const rows = panierBody.querySelectorAll('tr:not(#emptyRow)');
        if (rows.length === 0) {
            btnCloturer.disabled = true;
            btnCloturer.style.opacity = '0.6';
        } else {
            btnCloturer.disabled = false;
            btnCloturer.style.opacity = '1';
        }
    }

    // ---------- Ajouter produit ----------
    btnAjouter.addEventListener('click', function() {
        const selectedOption = selectProduit.options[selectProduit.selectedIndex];
        if (!selectedOption) return;

        const idProduit = selectedOption.value;
        const produitNom = selectedOption.text.split(' - ')[0];
        const prixUnit = parseFloat(selectedOption.dataset.prix);
        let quantite = parseInt(quantiteInput.value, 10);
        
        if (isNaN(quantite) || quantite < 1) quantite = 1;

        ajouterLigne(idProduit, produitNom, prixUnit, quantite);
        quantiteInput.value = 1;

        // Animation feedback
        btnAjouter.innerHTML = '<i class="bi bi-check-circle"></i> Ajouté !';
        setTimeout(() => {
            btnAjouter.innerHTML = '<i class="bi bi-plus-circle"></i> Ajouter au panier';
        }, 1000);
    });

    // ---------- Clôturer l'achat ----------
    btnCloturer.addEventListener('click', function() {
        const rows = panierBody.querySelectorAll('tr:not(#emptyRow)');
        
        if (rows.length === 0) {
            alert('Le panier est vide. Ajoutez des produits avant de clôturer.');
            return;
        }

        // Désactiver le bouton pendant l'envoi
        btnCloturer.disabled = true;
        btnCloturer.innerHTML = '<i class="bi bi-spinner"></i> En cours...';

        let panierDonnees = [];
        rows.forEach((row) => {
            const idProduit = row.dataset.id;
            const prixUnitaire = parseFloat(
                row.querySelector('.product-price').textContent
                    .replace(',', '.')
                    .replace(' €', '')
                    .trim()
            );
            const quantite = parseInt(
                row.querySelector('.product-qty').textContent.trim(), 10
            );

            panierDonnees.push({
                id_produit: idProduit,
                quantite_achetee: quantite,
                prix_unitaire: prixUnitaire
            });
        });

        // Envoi des données
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
                // Animation de succès
                btnCloturer.innerHTML = '<i class="bi bi-check-circle"></i> Validé !';
                btnCloturer.style.background = 'linear-gradient(135deg, #11998e 0%, #38ef7d 100%)';
                
                alert(`🧾 Achat validé en BDD !\nTicket N° : ${data.num_ticket}`);
                
                // Vider le panier
                panier = [];
                panierBody.innerHTML = '';
                toggleEmptyMessage();
                calculerTotal();
                updateCloturerButton();
                
                setTimeout(() => {
                    btnCloturer.innerHTML = '<i class="bi bi-cart-check"></i> Clôturer l\'achat';
                    btnCloturer.style.background = '';
                    btnCloturer.disabled = false;
                }, 2000);
            } else {
                alert('Erreur système : ' + data.message);
                btnCloturer.innerHTML = '<i class="bi bi-cart-check"></i> Clôturer l\'achat';
                btnCloturer.disabled = false;
            }
        })
        .catch(error => {
            console.error('Erreur AJAX :', error);
            alert('Impossible de joindre le serveur.');
            btnCloturer.innerHTML = '<i class="bi bi-cart-check"></i> Clôturer l\'achat';
            btnCloturer.disabled = false;
        });
    });

    // ---------- Raccourci Entrée ----------
    quantiteInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            btnAjouter.click();
        }
    });

    // ---------- Init ----------
    toggleEmptyMessage();
    updateCloturerButton();
    calculerTotal();
});