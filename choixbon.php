<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/title.php'); ?>
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header">
                <h2>NOUVEAU PRODUIT</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Voici les catégories disponibles pour ajouter un produit :</strong>
            </div>
            <div class="row text-center pad-top">
                <div class="menu-item">
                    <a href="bonnew">
                        <i class="fa fa-plus"></i>
                        <h4>Nouvelle vente</h4>
                    </a>
                    
                </div>
                <div class="menu-item">
                    <a href="bonall">
                        <i class="fa fa-folder"></i>
                        <h4>Ventes journalières</h4>
                    </a>
                    
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
