<?php
session_start();
include('include/functions.php');
include('include/linkdb.php');
$idession=session($_SESSION['admiD'], 'login');
include('include/execute.php');
$res=resultat($bdd, 'admin', 'idAdmin', $idession);
if (isset($_GET['getid']) && isset($_GET['fac']) && $_GET['fac']==md5($_GET['getid'])) {
  $fac=htmlspecialchars(trim($_GET['getid']));
  $ver=getBy2($bdd, 'factures', 'idFac', $fac, 'statut', 1);
  $v=nombre($ver);
  if ($v==1) {
    $r=fetch($ver);
    $day=date('d/m/Y');
    $heure=date('H:i');
    $modifier=$bdd->query("UPDATE factures SET paie='Dette', dateFac='$day', heureFac='$heure' WHERE idFac='$fac'");
    header('location:factureview?fac='.md5($fac)."&&getid=".$fac);
  }else{header('location: bonajouter');}
}else{header('location: bonajouter');}

?>

