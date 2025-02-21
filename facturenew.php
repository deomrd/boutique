<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header">
                <h2>RAPPORTS DE FACTURES</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Voici les sous-menus disponibles pour les rapports :</strong>
            </div>
            <div class="row text-center pad-top">
                <!-- Sous-menu Rapport Journalier -->
                <div class="menu-item">
                    <a href="rapport_journalier.php">
                        <i class="fa fa-calendar-day"></i>
                        <h4>Rapport Journalier</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Mensuel -->
                <div class="menu-item">
                    <a href="rapport_mensuel.php">
                        <i class="fa fa-calendar-alt"></i>
                        <h4>Rapport Mensuel</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Annuel -->
                <div class="menu-item">
                    <a href="rapport_annuel.php">
                        <i class="fa fa-calendar-year"></i>
                        <h4>Rapport Annuel</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Par Client -->
                <div class="menu-item">
                    <a href="rapport_par_client.php">
                        <i class="fa fa-user"></i>
                        <h4>Rapport Par Client</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Par Produit -->
                <div class="menu-item">
                    <a href="rapport_par_produit.php">
                        <i class="fa fa-cogs"></i>
                        <h4>Rapport Par Produit</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Par Statut -->
                <div class="menu-item">
                    <a href="rapport_par_statut.php">
                        <i class="fa fa-check-circle"></i>
                        <h4>Rapport Par Statut</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Par Date -->
                <div class="menu-item">
                    <a href="rapport_par_date.php">
                        <i class="fa fa-calendar"></i>
                        <h4>Rapport Par Date</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Par Vente -->
                <div class="menu-item">
                    <a href="rapport_par_vente.php">
                        <i class="fa fa-shopping-cart"></i>
                        <h4>Rapport Par Vente</h4>
                    </a>
                </div>

                <!-- Sous-menu Rapport Complexe avec Filtres -->
                <div class="menu-item">
                    <a href="rapport_complexe.php">
                        <i class="fa fa-filter"></i>
                        <h4>Rapport Complexe</h4>
                    </a>
                </div>

            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
