<?php
include('functions.php');
include('linkdb.php');
$idession = session($bdd, 'admin', 'idAdmin', $_SESSION['admiD']);
include('include/execute.php');
$res = resultat($bdd, 'admin', 'idAdmin', $idession);
$res1 = resultat($bdd, 'admin', 'idAdmin', $idession);
$priv = $_SESSION['priv'];

?>