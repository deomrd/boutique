<?php
session_start();
include('include/config.php');
$priv=onlyprincipal($_SESSION['priv'], 'produit');

if (isset($_GET['getid']) && isset($_GET['gerec'])) {
  $getid=prendre($_GET['getid']);
  $tac=prendre($_GET['gerec']);
  if($getid==md5($tac)){
    $req=getBy2($bdd, 'produits', 'statut', 1, 'idProd', $tac);
    $r=fetch($req);
    
  }else{ header('location : produit');}
}else{ header('location : produit'); }

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
                <h2><?= $r['nomProd'] ?></h2>
            </div>
            <div class="">
                <p><b>Vous pouvez approvisionner ce produit en complétant ce formulaire :</b>
                 </p>
                  <hr />
                
                  <form method="post">
                    <div class="col-lg-12 col-md-12" hidden>
                      <label for="prod">Nom du produit </label> <br>
                      <input type="text" name="prod" id="prod" placeholder="Nom de l'article" class="form-control" value="<?= $r['idProd'] ?>">
                    </div>

                    <div class="col-lg-12 col-md-12">
                      <label for="qtt">Nom du produit</label><br>
                      <input type="text" name="nom" id="nom" placeholder="Nom du produit" class="form-control" value="<?= $r['nomProd'] ?>">
                    </div>
                    <div class="col-lg-12 col-md-12">
                      <label for="qtt">Prix Unitaire</label><br>
                      <input type="text" name="prix" id="prix" placeholder="Prix unitaire du produit" class="form-control" value="<?= $r['prix'] ?>">
                    </div>

                    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
                      <input type="submit" name="modprod" value="Modifier" class="btn btn-primary">
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
