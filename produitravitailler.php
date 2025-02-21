<?php
session_start();
include('include/config.php');
$priv=onlyprincipal($_SESSION['priv'], 'produit');

if (isset($_GET['gerec']) && isset($_GET['getid'])) {
  $getid=prendre($_GET['getid']);
  $tac=prendre($_GET['gerec']);
  if($tac==md5($getid)){
    $req=getBy2($bdd, 'produits', 'statut', 1, 'idProd', $getid);
    $r=fetch($req);
    // var_dump($req); exit;
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
                      <label for="qtt">Quantité</label> (Disponible: <?= $r['quantite'] ?> ) <br>
                      <input type="number" name="qtt" id="qtt" placeholder="Quantité" class="form-control">
                    </div>

                    <div class="col-lg-12 col-md-12" style="margin-top: 10px;">
                      <input type="submit" name="ravitailler" value="Ajouter" class="btn btn-primary">
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
