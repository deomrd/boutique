<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
    <!-- Ajout du CDN pour Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header">
                <h2>GESTION DES FACTURES</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Voici les options disponibles pour gérer vos factures :</strong>
            </div>
            <div class="row text-center pad-top">
                <!-- Menu pour Nouvelle facture -->
                <div class="menu-item">
                    <a href="bonall">
                        <i class="bi bi-file-earmark-plus"></i> <!-- Nouvelle icône pour la nouvelle facture -->
                        <h4>Nouvelle facture</h4>
                    </a>
                </div>
                
                <!-- Menu pour Factures journalières -->
                <div class="menu-item">
                    <a href="factureday">
                        <i class="bi bi-folder"></i> <!-- Icône de dossier pour Factures journalières -->
                        <h4>Factures journalières</h4>
                    </a>
                </div>

                <!-- Menu pour Historique des factures -->
                <div class="menu-item">
                    <a href="factureall">
                        <i class="bi bi-clock-history"></i> <!-- Icône pour Historique -->
                        <h4>Historique des factures</h4>
                    </a>
                </div>

                <!-- Menu pour Factures impayées -->
                <div class="menu-item">
                    <a href="factureunpaid">
                        <i class="bi bi-file-earmark-x"></i> <!-- Icône pour Factures impayées -->
                        <h4>Factures impayées</h4>
                    </a>
                </div>

                <!-- Menu pour Recherche de factures -->
                <div class="menu-item">
                    <a href="facturesearch">
                        <i class="bi bi-search"></i> <!-- Icône pour Recherche -->
                        <h4>Rechercher une facture</h4>
                    </a>
                </div>
            </div>



        </div>

        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
