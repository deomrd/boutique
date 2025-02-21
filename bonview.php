<?php
session_start();
include('include/config.php');
$facture=verificationurl($bdd, 'factures', 'idFac', $_GET['getid'], $_GET['fac'], 'bonnew' );
if(!empty($facture['paie'])){header('location: bonall');}

$nom_client = $facture["nomCl"];
$numero_client = $facture["phone"];
$date_facture = $facture["dateFac"];
$facture_id = "BON-100".$facture["idFac"];

$idFacture = $facture['idFac'];
$articles=getBy1ord($bdd, 'detailfacture', 'idFac', $idFacture, 'nomProd', 'ASC');



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
    <link rel="stylesheet" href="assets/css/facture.css"> <!-- Lien vers le fichier CSS externe -->
</head>

<body>
    <div id="wrapper">
    <?php include('include/retour.php'); ?>
    <div id="page-wrapper" class="facture-container">
        <div class="facture-header">
            <center><h2>BON Nº <?= $facture_id ?></h2></center>
        </div>
        <div class="facture-details">
            <p><strong>Client:</strong> <?= $nom_client ?></p>
            <p><strong>Téléphone:</strong> <?= $numero_client ?></p>
            <p><strong>Date:</strong> <?= $date_facture ?></p>
        </div>
        <div class="btn-group">
            <a href="#" class="btn btn-success" data-action="Cash" data-facture="<?= $idFacture ?>"><i class="fa fa-money"></i> Cash</a>
            <a href="#" class="btn btn-primary" data-action="Dette" data-facture="<?= $idFacture ?>"><i class="fa fa-credit-card"></i> Dette</a>
            <a href="#" class="btn btn-danger" data-action="Annuler" data-facture="<?= $idFacture ?>"><i class="fa fa-times-circle"></i> Annuler</a>
            <!-- <button onClick="printFacture()" class="btn btn-warning"><i class="fa fa-print"></i> Print</button> -->
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>LIBELLÉ</th>
                    <th>PRIX U</th>
                    <th>QUANTITÉ</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; foreach ($articles as $article): ?>
                    <tr>
                        <td><?= $article['nomProd'] ?></td>
                        <td><?= number_format($article['prix'], 0, ',', ' ') ?> $</td>
                        <td><?= $article['quanProd'] ?></td>
                        <td><?= number_format($article['prix'] * $article['quanProd'], 0, ',', ' ') ?> $</td>
                    </tr>
                <?php $total += $article['prix'] * $article['quanProd']; endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">TOTAL</th>
                    <th><?= number_format($total, 0, ',', ' ') ?> $</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <?php include('include/footer.php'); ?>

    <!-- Modal -->
    <div id="actionModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle"></h2>
                <span class="close" onclick="closeModal()">&times;</span>
            </div>
            <div class="modal-body">
                <p id="modalMessage"></p>
            </div>
            <div class="modal-footer">
                <button class="cancel-btn" onclick="closeModal()">Annuler</button>
                <button id="modalConfirmBtn">Confirmer</button>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/facture.js">
    
</script> <!-- Lien vers le fichier JavaScript externe -->
</body>
</html>