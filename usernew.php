<?php
session_start();
include('include/config.php');
$idprv=onlyprincipal($_SESSION['priv'], 'index');
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
                <form action="" method="post" onsubmit="return checkQuantities();">
                    <!-- Informations du client -->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <center><label for="client">Nom (*) :</label></center>
                            <input type="text" name="nom" id="client" class="form-control" placeholder="Entrez le nom" value="<?php if(isset($_POST['nom'])){echo $_POST['nom'];}?>">
                        </div>
                        <div class="form-group col-md-6">
                            <center><label for="postnom">Post-nom :</label></center>
                            <input type="text" name="postnom" id="postnom" class="form-control" placeholder="Entrez le nom de famille" value="<?php if(isset($_POST['postnom'])){echo $_POST['postnom'];}?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <center><label for="adresse">Adresse :</label></center>
                            <input type="text" name="adresse" id="adresse" class="form-control" placeholder="Entrez l'adresse de residence" value="<?php if(isset($_POST['adresse'])){echo $_POST['adresse'];}?>">
                        </div>
                        <div class="form-group col-md-6">
                            <center><label for="phone">Téléphone (*):</label></center>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Entrez le numéro de téléphone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <center><label for="username">Nom d'utilisateur(*):</label></center>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Entrez le nom d'utilisateur" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>">
                        </div>
                        <div class="form-group col-md-6">
                            <center><label for="password">Mot de passe (*):</label></center>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Entrez votre mot de passe">
                        </div>
                    </div>

                   

                    <!-- Boutons d'action -->
                    <div class="row">
                        
                        <div class="col-md-12 text-center mt-3">
                            <button type="submit" name="usernew" class="btn btn-primary">Créer utilisateur</button>
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