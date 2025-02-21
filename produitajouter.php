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
            <div class="">
                <h2>Nouveau produit</h2>
            </div>
            <div class="">
                <p><b>Vous pouvez ajouter un produit en complétant ce formulaire :</b>
                 </p>
                  <hr />
                
                  <form method="post">
                    <div class="col-lg-12 col-md-12">
                      <label for="prod">Nom du produit </label> <br>
                      <input type="text" name="nom" id="nom" placeholder="Nom du produit" class="form-control">
                    </div>

                    <div class="col-lg-12 col-md-12">
                      <label for="qtt">Prix du produit</label><br>
                      <input type="text" name="prix" id="prix" placeholder="Prix unitaire du produit" class="form-control">
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <label for="qtt">Unité </label><br>
                      <input type="text" name="unite" id="unite" placeholder="Unité" class="form-control">
                    </div>

                    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
                      <input type="submit" name="create" value="Enregistrer" class="btn btn-primary">
                    </div>
                    <br>
                    <div style="text-align: center; font-weight: bold;">
                      <?php if (isset($erreur)) { echo $erreur; } ?>
                    </div>
                  </form> 
                
            
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
