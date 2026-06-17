// assets/js/auth.js

document.addEventListener('DOMContentLoaded', function() {
    // Gestion du bouton de connexion
    const form = document.querySelector('form');
    const btn = document.querySelector('.btn-auth');

    if (form && btn) {
        form.addEventListener('submit', function() {
            btn.innerHTML = '<i class="bi bi-spinner"></i> Connexion...';
            btn.disabled = true;
            btn.style.opacity = '0.7';
            btn.style.cursor = 'not-allowed';
        });
    }

    // Effet de focus sur les champs
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.form-group').querySelector('.form-label i')
                .style.color = '#764ba2';
        });
        input.addEventListener('blur', function() {
            this.closest('.form-group').querySelector('.form-label i')
                .style.color = '#667eea';
        });
    });
});