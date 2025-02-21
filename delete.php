<?php
session_start();
include('include/config.php');
$idession=session($_SESSION['priv'], 'index');




if (isset($_GET['getid']) && isset($_GET['gerec'])) {
  $getid=prendre($_GET['getid']);
  $tac=prendre($_GET['gerec']);
  if($getid==md5($tac)){
    $req=$bdd->query("UPDATE produits SET statut=0 WHERE idProd='$tac'");
    header('location: produit');
    
  }else{ header('location : produit');}
}else{ header('location : produit'); }

if (isset($_GET['gebss'])) {
  $boi=prendre($_GET['gebss']);
  $req=$bdd->query("UPDATE boisson SET statut=0 WHERE idProd='$boi'");
  header('location: boissons');
}


if (isset($_GET['getserv'])) {
  // $user=prendre($_GET['getserv']);
  // var_dump($user); exit;
  // $req=$bdd->query("UPDATE serveurs SET statut=0 WHERE idServ='$user'");
  // header('location: serveurs');
}