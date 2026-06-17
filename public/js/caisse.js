// assets/js/caisse.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formConnexion');
    const btn = document.getElementById('btnValiderConnexion');
    const select = document.getElementById('selectCaisse');

    // Gestion du bouton de validation
    if (form && btn) {
        form.addEventListener('submit', function(e) {
            // Vérification si une caisse est sélectionnée
            if (!select.value) {
                e.preventDefault();
                select.style.borderColor = '#dc2626';
                select.style.boxShadow = '0 0 0 4px rgba(220,38,38,0.15)';
                setTimeout(() => {
                    select.style.borderColor = '#e5e7eb';
                    select.style.boxShadow = 'none';
                }, 2000);
                return;
            }

            btn.classList.add('loading');
            btn.innerHTML = '<i class="bi bi-spinner"></i> Validation...';
            btn.disabled = true;
        });
    }

    // Animation au survol de la carte
    const card = document.querySelector('.caisse-card');
    if (card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    }
});