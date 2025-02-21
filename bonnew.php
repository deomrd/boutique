<?php
session_start();
include('include/config.php');

// Récupération des produits actifs
$stmt = $bdd->query("SELECT * FROM produits WHERE statut=1");
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/facturecss.php'); ?>
</head>

<body>
    <?php include('include/retour.php'); ?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="header">
                <h2>NOUVEAU PRODUIT</h2>
                <p>Bienvenue, <?= $res1['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Ecrivez un bon de commande en complétant ce formulaire :</strong>
            </div>
            <div class="form-container">
                <!-- Formulaire principal -->
                <form action="traiter_facture.php" method="post" onsubmit="return checkQuantities();">
                    <!-- Informations du client -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="client">Nom du Client :</label>
                            <input type="text" id="client" name="client" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Téléphone :</label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>
                    </div>

                    <!-- Section des produits -->
                    <div id="produits">
                        <!-- Produit initial -->
                        <div class="produit" id="produit_1">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="produit_nom_1">Nom du Produit :</label>
                                    <input type="text" id="produit_nom_1" name="produit_nom[]" class="form-control autocomplete-produit" required>
                                    <input type="hidden" id="produit_id_1" name="produit_id[]">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="produit_quantite_1">Quantité :</label>
                                    <input type="number" id="produit_quantite_1" name="produit_quantite[]" class="form-control" required>
                                </div>
                                <div class="form-group col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-supprimer" onclick="supprimerProduit(1)">Supprimer</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-primary btn-ajouter" onclick="ajouterProduit()">Ajouter un Produit</button>
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <input type="submit" class="btn btn-success" value="Enregistrer Facture">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>

    <!-- Inclusion de jQuery, jQuery UI et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

    <script>
        var produitCount = 1; // Compteur pour les produits
        var produitsDisponibles = <?php echo json_encode($produits); ?>; // Liste des produits disponibles

        // Fonction pour initialiser l'autocomplétion
        function initialiserAutocompletion() {
            $(".autocomplete-produit").autocomplete({
                source: function (request, response) {
                    var term = request.term.toLowerCase();
                    var filteredProduits = produitsDisponibles.filter(function (produit) {
                        return produit.nomProd.toLowerCase().includes(term) && !produit.dejaSelectionne;
                    });
                    response(filteredProduits.map(function (produit) {
                        return {
                            label: produit.nomProd,
                            value: produit.nomProd,
                            id: produit.idProd,
                            stock: produit.quantite
                        };
                    }));
                },
                select: function (event, ui) {
                    var id = ui.item.id;
                    var nom = ui.item.label;
                    var stock = ui.item.stock;

                    // Mettre à jour le champ de saisie et le champ caché
                    $(this).val(nom);
                    $(this).closest('.produit').find('input[type="hidden"]').val(id);

                    // Mettre à jour la quantité maximale
                    var quantiteInput = $(this).closest('.produit').find('input[type="number"]');
                    quantiteInput.attr('max', stock);

                    // Marquer le produit comme sélectionné
                    produitsDisponibles.forEach(function (produit) {
                        if (produit.idProd === id) { // Utiliser === pour une comparaison stricte
                            produit.dejaSelectionne = true;
                        }
                    });

                    // Fermer la boîte de dialogue d'autocomplétion
                    $(this).autocomplete("close");

                    // Réinitialiser l'autocomplétion pour les autres champs
                    $(".autocomplete-produit").not(this).autocomplete("refresh");
                }
            });
        }

        // Fonction pour ajouter un nouveau produit
        function ajouterProduit() {
            produitCount++;
            var produitsDiv = document.getElementById('produits');

            var nouveauProduit = document.createElement('div');
            nouveauProduit.className = 'produit';
            nouveauProduit.id = 'produit_' + produitCount;
            nouveauProduit.innerHTML = `
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="produit_nom_${produitCount}">Nom du Produit :</label>
                        <input type="text" id="produit_nom_${produitCount}" name="produit_nom[]" class="form-control autocomplete-produit" required>
                        <input type="hidden" id="produit_id_${produitCount}" name="produit_id[]">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="produit_quantite_${produitCount}">Quantité :</label>
                        <input type="number" id="produit_quantite_${produitCount}" name="produit_quantite[]" class="form-control" required>
                    </div>
                    <div class="form-group col-md-2 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-supprimer" onclick="supprimerProduit(${produitCount})">Supprimer</button>
                    </div>
                </div>
            `;
            produitsDiv.appendChild(nouveauProduit);
            initialiserAutocompletion(); // Initialiser l'autocomplétion pour le nouveau champ
        }

        // Fonction pour supprimer un produit
        function supprimerProduit(id) {
            var produitDiv = document.getElementById('produit_' + id);
            var produitIdInput = produitDiv.querySelector('input[type="hidden"]');
            var produitId = produitIdInput.value;

            // Réactiver le produit dans la liste des produits disponibles
            produitsDisponibles.forEach(function (produit) {
                if (produit.idProd === produitId) { // Utiliser === pour une comparaison stricte
                    produit.dejaSelectionne = false; // Réactiver le produit
                }
            });

            // Supprimer le produit du formulaire
            produitDiv.remove();

            // Réinitialiser l'autocomplétion pour les autres champs
            $(".autocomplete-produit").autocomplete("refresh");
        }

        // Fonction pour vérifier les quantités avant soumission
        function checkQuantities() {
            var produits = document.getElementsByClassName('produit');
            for (var i = 0; i < produits.length; i++) {
                var produitIdInput = produits[i].querySelector('input[type="hidden"]');
                var quantiteInput = produits[i].querySelector('input[type="number"]');
                var produit = produitsDisponibles.find(function (p) {
                    return p.idProd === produitIdInput.value; // Utiliser === pour une comparaison stricte
                });

                if (produit && parseInt(quantiteInput.value) > parseInt(produit.quantite)) {
                    alert('La quantité demandée pour ' + produit.nomProd + ' dépasse la quantité en stock. Quantité en stock : ' + produit.quantite);
                    return false;
                }
            }
            return true;
        }

        // Initialiser l'autocomplétion au chargement de la page
        $(document).ready(function () {
            initialiserAutocompletion();
        });
    </script>
</body>

</html>