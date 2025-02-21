<?php
session_start();
include('include/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/facturecss.php'); ?>
    
</head>

<body class="container">
    <div id="wrapper">
        <div id="page-wrapper">
            <?php include('include/retour.php'); ?>
            <div class="container header">
                <h2>CREER UN UTILISATEUR</h2>
                
            </div>
            <div class="form-container">
                <!-- Formulaire principal -->
                <form action="" method="post" >
                  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <center><label for="user1">Actuel nom d'utilisateur (*) :</label></center>
                            <input type="text" name="user1" id="user1" class="form-control" placeholder="Entrez l'actuel nom d'utilisateur" >
                        </div>
                        <div class="form-group col-md-6">
                            <center><label for="mdp1">Actuel mot de passe (*) :</label></center>
                            <input type="password" name="mdp1" id="mdp1" class="form-control" placeholder="Entrez l'actuel mot de passe" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <center><label for="user2">Nouveau nom d'utilisateur (*) :</label></center>
                            <input type="text" name="user2" id="user2" class="form-control" placeholder="Entrez le nouveau nom d'utilisateur" >
                        </div>
                        <div class="form-group col-md-6">
                            <center><label for="mdp2">Nouveau mot de passe (*) :</label></center>
                            <input type="password" name="mdp2" id="mdp2" class="form-control" placeholder="Entrez le nouveau mot de passe" >
                        </div>
                    </div>

                   

                    <!-- Boutons d'action -->
                    <div class="row">
                        
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" name="update" class="btn btn-primary">Créer utilisateur</button>
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