<?php
session_start();
include('include/functions.php');
include('include/linkdb.php');
include('include/execute.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/facturecss.php'); ?>
</head>

<body class="container">
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="container header">
                <h2>SE CONNECTER</h2>
                
            </div>
            <div class="alert">
                <strong>Bienvenueau système de PIO Business, connectez-vous en complétant ce formulaire :</strong>
            </div>
            <div class="form-container">
                <!-- Formulaire principal -->
                <form action="" method="post" onsubmit="return checkQuantities();">
                    <!-- Informations du client -->
                    <div class="row">
                        <div class="form-group col-md-12">
                            <center><label for="client">Nom du Client :</label></center>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Entrez votre identifiant">
                        </div>
                        <div class="form-group col-md-12">
                            <center><label for="phone">Mot de passe :</label></center>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" name="login" class="btn btn-primary">Connexion</button>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        
                        <div class="col-md-12 text-center">
                            <a href="signup" class="btn btn-success btn-sm">Créer un compte</a>
                        </div>
                    </div>

                    
                    <div class="row" style="color: red;">
                        <b><center>
                            <?php 
                                if(isset($erreur)){
                                    echo $erreur;
                                }
                            ?></center>
                        </b>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Inclusion de jQuery, jQuery UI et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</body>

</html