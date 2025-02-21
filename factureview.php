<?php
session_start();
include('include/config.php');

$facture = verificationurl($bdd, 'factures', 'idFac', $_GET['getid'], $_GET['fac'], 'bonnew');

$nom_client = $facture["nomCl"];
$numero_client = $facture["phone"];
$date_facture = $facture["dateFac"];
$facture_id = "FACTURE-100" . $facture["idFac"];

$idFacture = $facture['idFac'];
$articles = getBy1ord($bdd, 'detailfacture', 'idFac', $idFacture, 'nomProd', 'ASC');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
    <link rel="stylesheet" href="assets/css/facture.css"> <!-- Lien vers le fichier CSS externe -->
    <style>
        /* Styles d'impression */
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                color: #000;
                background: #fff;
            }

            .btn-group, /* Masquer les boutons */
            footer {
                display: none;
            }

            .facture-container {
                padding: 20px;
                margin: 0 auto;
                width: 100%;
                max-width: 800px;
                border: none;
            }

            .facture-header h2 {
                font-size: 24px;
                text-align: center;
                margin-bottom: 20px;
            }

            .facture-details p {
                margin: 5px 0;
                font-size: 14px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th, td {
                border: 1px solid #000;
                text-align: left;
                padding: 8px;
                font-size: 14px;
            }

            th {
                background: #f0f0f0;
            }

            tfoot th {
                font-weight: bold;
                text-align: right;
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper" class="facture-container">
            <div class="facture-header">
                <center>
                    <h2> Nº <?= $facture_id ?></h2>
                </center>
            </div>
            <div class="facture-details">
                <p><strong>Client:</strong> <?= $nom_client ?></p>
                <p><strong>Téléphone:</strong> <?= $numero_client ?></p>
                <p><strong>Date:</strong> <?= $date_facture ?></p>
                <p><strong>Payé:</strong> <?= $facture['paie'] ?></p>
            </div>
            <div class="btn-group">
                <button onClick="window.print()" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
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
                    <?php $total = 0;
                    foreach ($articles as $article) : ?>
                        <tr>
                            <td><?= $article['nomProd'] ?></td>
                            <td><?= number_format($article['prix'], 0, ',', ' ') ?> $</td>
                            <td><?= $article['quanProd'] ?></td>
                            <td><?= number_format($article['prix'] * $article['quanProd'], 0, ',', ' ') ?> $</td>
                        </tr>
                        <?php $total += $article['prix'] * $article['quanProd'];
                    endforeach; ?>
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
    </div>
</body>

</html>
