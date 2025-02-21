<?php
session_start();
include('include/config.php');

// Récupérer l'ID de la facture et l'action depuis l'URL
$facture_id = isset($_GET['getid']) ? intval($_GET['getid']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Vérifier si l'ID de la facture et l'action sont valides
if ($facture_id <= 0 || !in_array($action, ['cash', 'dette', 'annuler'])) {
    die("Requête invalide.");
}

$facture=existanceBdd($bdd, 'factures', 'idFac', $facture_id, 'bonnew');

// Mettre à jour le champ `paie` dans la table `factures`
try {
    $stmt = $bdd->prepare("UPDATE factures SET paie = :paie WHERE idFac = :idFac");
    $stmt->execute([
        ':paie' => $action,
        ':idFac' => $facture_id
    ]);

    // Rediriger l'utilisateur vers une autre page après la mise à jour
    switch ($action) {
        case 'cash':
            header("location: factureview?getid=".$facture_id."&&fac=".md5($facture_id)); 
            break;
        case 'dette':
            header("location: factureview?getid=".$facture_id."&&fac=".md5($facture_id)); 
            break;
        case 'annuler':
            header("location: factureview?getid=".$facture_id."&&fac=".md5($facture_id)); 
            break;
        default:
            header("Location: bonnew"); // Rediriger vers une page par défaut
            break;
    }
    exit();
} catch (PDOException $e) {
    die("Erreur lors de la mise à jour de la facture : " . $e->getMessage());
}