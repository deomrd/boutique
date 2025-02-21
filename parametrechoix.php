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
                <h2>PARAMÈTRES</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Voici les options disponibles dans les paramètres :</strong>
            </div>
            <div class="row text-center pad-top">
                <!-- Gestion des utilisateurs -->
                <?php if(isset($priv) && $priv==1){
                ?>

                <div class="menu-item">
                    <a href="param_users">
                        <i class="fa fa-users"></i>
                        <h4>Utilisateurs</h4>
                    </a>
                </div>
                <?php
                } ?>
                <!-- Sécurité -->
                <div class="menu-item">
                    <a href="param_security">
                        <i class="fa fa-lock"></i>
                        <h4>Sécurité</h4>
                    </a>
                </div>
            </div>
        </div>
        <footer>
            © <?= date('Y'); ?> Votre entreprise - Tous droits réservés.
        </footer>
    </div>
</body>

</html>
