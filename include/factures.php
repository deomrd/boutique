<?php
$getid=prendre($_GET['tac']);
$voir=getBy1($bdd, 'factures', 'idFac', $getid);
$v=fetch($voir);
$fac=$getid;

if($v['etat']==0){
?>
<form method="post">
  <input type="number" name="fac" value="<?= $tac; ?>" hidden>
<?php include('include/form2.php'); ?>
<?php include('include/form3.php'); ?>
<?php include('include/form4.php'); ?>



  
  <div class="col-lg-3 col-md-3">
  <input type="submit" name="fermer" value="Fermer et imprimer" class="btn btn-info"> <br>
    
  <table class="table table-hover table-bordered" style="margin-top: 10px;">
    <tr>
      <th>Libelle</th>
      <th>Qtt</th>
      <th>P.T</th>
    </tr>
    <!-- boisson -->
    <?php
    
    

    $req=getBy2ord($bdd, 'detailfacture', 'statut', 1, 'idFac', $fac, 'idDetFac', 'DESC');
    foreach ($req as $r) {
  ?>
    <tr>
      <td><?= $r['nomProd']; ?></td>
      <td><?= $r['quanProd']; ?></td>                  
      <td><?= $r['prix']*$r['quanProd']; ?> <?= $r['devise']; ?></td>
    </tr>
    <?php } ?>
  </table>

  </div>
  <div class="col-lg-12 col-md-12 text-danger">
    <center><b><?php 
      if(isset($erreur)){
        echo $erreur;
      }
    ?></b></center>
  </div>
  </form>
<?php } ?>