<?php
session_start();
include('include/config.php');
?>
<!DOCTYPE html>
<html>
<?php include('include/head.php'); ?>
<body>   
    <div id="wrapper">
         <?php include('include/header1.php'); ?>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-lg-12">
                     <h2>FACTURES</h2>   
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                    <div class="col-lg-12 ">
                        <div class="alert alert-info">
                             <strong>Bienvenue <?= $res['nom']; ?>! </strong>
                        </div>
                       
                    </div>
                    </div>
                  <!-- /. ROW  --> 
                <div class="row text-center pad-top">

                  <?php
                    if($_SESSION['priv']==1){
                  ?>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="div-square">
                           <a href="create" >
                            <i class="fa fa-circle-o fa-5x"></i>
                      <h4>NOUVEAU PRODUIT</h4>
                      </a>
                      </div>
                  </div>
                  <?php
                    }
                  ?>
                

                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="div-square">
                           <a href="produit" >
                            <i class="fa fa-circle-o fa-5x"></i>
                      <h4>STOCK</h4>
                      </a>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>
    </div>
    <?php include('include/footer.php'); ?>

    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
