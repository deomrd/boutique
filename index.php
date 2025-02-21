<?php
session_start();
include('include/config.php');


$fermer = $bdd->query("UPDATE factures SET etat=1 WHERE etat=0 && statut=1");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/title.php'); ?>

</head>

<body>
    <div id="wrapper">

        <div id="page-wrapper">
            <center>
                <a href="logout" class="btn btn-danger back-btn"> <i class="fa fa-power-off fa-lg"></i></a>
            </center>
            <div class="header">
                <h2>MENU PRINCIPAL</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Ménu de navigation</strong>
            </div>
            <div class="row">
                <div class="menu-item">
                    <a href="produit">
                        <i class="fa fa-cubes"></i>
                        <h4>STOCK</h4>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="choixbon">
                        <i class="fa fa-folder"></i>
                        <h4>VENTES</h4>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="facturechoix">
                        <i class="fa fa-file-text"></i>
                        <h4>FACTURES</h4>
                    </a>
                </div>
                <?php
                    if($priv==1){
                ?>
                <div class="menu-item">
                    <a href="rapportchoix">
                        <i class="fa fa-clipboard"></i>
                        <h4>RAPPORTS</h4>
                    </a>
                </div>
                <?php
                    }
                ?>
                
                <div class="menu-item">
                    <a href="parametrechoix">
                        <i class="fa fa-cogs"></i>
                        <h4>PARAMÈTRES</h4>
                    </a>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
