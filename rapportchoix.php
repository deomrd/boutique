<?php
session_start();
include('include/config.php');
$priv=onlyprincipal($_SESSION['priv'], 'produit');

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
        <a href="rapportday">
            <i class="fa fa-sun-o"></i> <!-- Icône pour le rapport journalier -->
            <h4>Rapport Journalier</h4>
        </a>
    </div>
    <div class="menu-item">
        <a href="rapportmois">
            <i class="fa fa-calendar-o"></i> <!-- Icône pour le rapport mensuel -->
            <h4>Rapport Mensuel</h4>
        </a>
    </div>
    <div class="menu-item">
        <a href="rapportannuel">
            <i class="fa fa-calendar"></i> <!-- Icône pour le rapport annuel -->
            <h4>Rapport Annuel</h4>
        </a>
    </div>
    <div class="menu-item">
        <a href="rapportsearch">
            <i class="fa fa-search"></i> <!-- Icône pour le rapport par intervalle -->
            <h4>Rapport Personnalisé</h4>
        </a>
    </div>
</div>

        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
