<?php
session_start();
include('include/config.php');
$serveur=$res['idAdmin'];

// Récupération des données du formulaire
$client = $_POST['client'];
$phone = $_POST['phone'];
$produits_nom = $_POST['produit_id'];
$nomProduit= $_POST['produit_nom'];
// var_dump($produits_nom); exit;
$produits_quantite = $_POST['produit_quantite'];

// Insérer les données dans la table 'factures'
try {
    $bdd->beginTransaction();
    $now = date('d/m/Y');
    $heure = date('h:i');
    // Insérer bon
    $stmt = $bdd->prepare("INSERT INTO factures (nomCl, phone, dateFac, heureFac, serveur, etat, statut) VALUES (:nomCl, :phone,:dateFac, :heureFac, :serveur, :etat, :statut)");
    $stmt->execute([
        'nomCl' => $client,
        'phone' => $phone,
        'dateFac' => $now,
        'heureFac' => $heure,
        'serveur' => $serveur,
        'etat' => 0,
        'statut' => 1,
    ]);
    $bon_id = $bdd->lastInsertId();

    // Préparer l'insertion des produits de la commande
    $stmt = $bdd->prepare("INSERT INTO detailfacture (idFac, idProd, nomProd,  prix, quanProd, statut) VALUES (:idFac, :idProd, :nomProd, :prix, :quanProd, :statut)");

    // Préparer la mise à jour de la quantité en stock
    $updateStockStmt = $bdd->prepare("UPDATE produits SET quantite = quantite - :quantitedemandee WHERE idProd = :idProd AND statut = 1");

    for ($i = 0; $i < count($produits_nom); $i++) {
        // Récupérer le prix du produit
        $stmtPrix = $bdd->query("SELECT prix FROM produits WHERE idProd = '$produits_nom[$i]' AND statut = 1");
        // var_dump($stmtPrix); exit;
        $produit = $stmtPrix->fetch(PDO::FETCH_ASSOC);
        
        $prix = $produit['prix'];

        // Insérer les produits de la commande
        $stmt->execute([
            'idFac' => $bon_id,
            'idProd' => $produits_nom[$i],
            'nomProd' => $nomProduit[$i],
            'quanProd' => $produits_quantite[$i],
            'prix' => $prix,
            'statut' => 1
        ]);

        // Mettre à jour la quantité en stock
        $updateStockStmt->execute([
            'quantitedemandee' => $produits_quantite[$i],
            'idProd' => $produits_nom[$i],
        ]);
    }

    $bdd->commit();
     header("Location: bonview?getid=".$bon_id."&&fac=".md5($bon_id));
} catch (Exception $e) {
    $bdd->rollBack();
    echo "Échec de l'enregistrement de la facture : " . $e->getMessage();
}
?>
