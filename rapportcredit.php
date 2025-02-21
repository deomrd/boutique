<?php
session_start();
include('include/config.php');
$priv=onlyprincipal($_SESSION['priv'], 'produit');
?>
<!DOCTYPE html>
<html>
<?php include('include/head.php'); ?>
<body>
     
           
          
    <div id="wrapper">
         <?php include('include/header.php'); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>VENTES JOURNALIERES A CREDIT</h2>   
                    </div>
                </div> 
                <hr />
                <div class="row text-center pad-top">
                  <div class="col-lg-12 col-md-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <tr class="bg bg-primary">
                        <th style="text-align: center;">Qtt</th>
                        <th style="text-align: center;">Libelle</th>
                        <th style="text-align: center;">Prix U.</th>
                        <th style="text-align: center;">Prix T.</th>
                      </tr>
                  </thead>
                  <tfoot>
                    <tr class="bg bg-primary">
                        <th style="text-align: center;">Qtt</th>
                        <th style="text-align: center;">Libelle</th>
                        <th style="text-align: center;">Prix U.</th>
                        <th style="text-align: center;">Prix T.</th>
                      </tr>
                  </tfoot>
                  <tbody>

                    <?php
                    $day=date('d/m/Y');
                    // var_dump($day); exit;
                      $req=$bdd->query("SELECT * FROM factures f, detailfacture d WHERE f.statut=1 && d.statut=1 && f.idFac=d.idFac && f.dateFac='$day' && f.paie='Dette' ORDER BY d.nomProd ASC");
                      // var_dump(nombre($req)); exit;
                      $somme=0;
                      foreach ($req as $res) {
                      ?>
                      <tr>
                        <td><?= $res['quanProd'] ?></td>
                        <td><?= $res['nomProd'] ?></td>
                        <td><?= $res['prix']. " ".$res['devise'] ?></td>
                        <td><?= $res['quanProd']*$res['prix']. " ".$res['devise'] ?></td>
                      </tr>
                      <?php
                      $pt=$res['prix']*$res['quanProd'];
                      $somme=$somme+$pt;
                     
                      }
                      echo "<b>Entrées journalières : ". $somme .$res['devise']."</b>";
                    ?>

                  </tbody>
                </table>
                  </div>               
                </div>
          </div>
      </div>
    </div>


    <?php include('include/footer.php'); ?>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <?php include('include/script.php'); ?>
</body>
</html>
