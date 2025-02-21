// Fonction pour afficher le modal
function showModal(action, factureId) {
    let title = '';
    let message = '';
    let confirmBtn = document.getElementById('modalConfirmBtn');

    if (action === 'Cash') {
        title = 'Paiement en Cash';
        message = 'Êtes-vous sûr de vouloir enregistrer ce paiement en cash ?';
        confirmBtn.onclick = function () {
            window.location.href = `traitement_paiement.php?getid=${factureId}&action=cash`;
        };
    } else if (action === 'Dette') {
        title = 'Paiement par Dette';
        message = 'Êtes-vous sûr de vouloir enregistrer ce paiement comme dette ?';
        confirmBtn.onclick = function () {
            window.location.href = `traitement_paiement.php?getid=${factureId}&action=dette`;
        };
    } else if (action === 'Annuler') {
        title = 'Annulation de la Facture';
        message = 'Êtes-vous sûr de vouloir annuler cette facture ?';
        confirmBtn.onclick = function () {
            window.location.href = `traitement_paiement.php?getid=${factureId}&action=annuler`;
        };
    }

    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('actionModal').style.display = 'block';
}

// Fonction pour fermer le modal
function closeModal() {
    document.getElementById('actionModal').style.display = 'none';
}

// Fermer le modal si l'utilisateur clique en dehors
window.onclick = function (event) {
    const modal = document.getElementById('actionModal');
    if (event.target === modal) {
        closeModal();
    }
};

// Gestion des clics sur les boutons d'action
document.querySelectorAll('.btn-group a').forEach(button => {
    button.addEventListener('click', (e) => {
        e.preventDefault();
        const action = button.getAttribute('data-action');
        const factureId = button.getAttribute('data-facture');
        showModal(action, factureId);
    });
});
