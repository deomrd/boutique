<?php

// Connexion à la base de données avec PDO
function connectToDatabase() {
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "gestion_stock_vente";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        die("La connexion à la base de données a échoué : " . $e->getMessage());
    }
}

// Fonctions pour les guichets

function getGuichetsActifs($conn) {
    $sql = "SELECT * FROM guichets WHERE statut = 'actif'";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addGuichet($conn, $nom_guichet) {
    try {
        // Vérifier si le guichet existe déjà
        if (guichetExisteDeja($conn, $nom_guichet)) {
            return false; // Le guichet existe déjà
        }

        $sql = "INSERT INTO guichets (nom_guichet, statut) VALUES (:nom_guichet, 'actif')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_guichet', $nom_guichet);
        return $stmt->execute();
    } catch(PDOException $e) {
        return false; // Gérer l'erreur ici (optionnel)
    }
}

function guichetExisteDeja($conn, $nom_guichet) {
    $sql = "SELECT COUNT(*) AS count FROM guichets WHERE nom_guichet = :nom_guichet";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_guichet', $nom_guichet);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

// Fonctions pour les produits

function getProduitsActifs($conn) {
    $sql = "SELECT * FROM produits WHERE statut = 'actif'";
    $stmt = $conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function ajouterProduit($conn, $nom_produit, $description, $prix_unitaire, $quantite_stock) {
    try {
        // Vérifier si le produit existe déjà
        if (produitExisteDeja($conn, $nom_produit)) {
            return false; // Le produit existe déjà
        }

        $sql = "INSERT INTO produits (nom_produit, description, prix_unitaire, quantite_stock, statut) 
                VALUES (:nom_produit, :description, :prix_unitaire, :quantite_stock, 'actif')";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom_produit', $nom_produit);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix_unitaire', $prix_unitaire);
        $stmt->bindParam(':quantite_stock', $quantite_stock);
        return $stmt->execute();
    } catch(PDOException $e) {
        return false; // Gérer l'erreur ici (optionnel)
    }
}

function produitExisteDeja($conn, $nom_produit) {
    $sql = "SELECT COUNT(*) AS count FROM produits WHERE nom_produit = :nom_produit";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nom_produit', $nom_produit);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['count'] > 0;
}

// Fonctions pour les commandes

function passerCommande($conn, $nom_client, $guichet_id, $articles) {
    try {
        $conn->beginTransaction();

        $sql_commande = "INSERT INTO commandes (nom_client, guichet_id, statut) VALUES (:nom_client, :guichet_id, 'en_attente')";
        $stmt_commande = $conn->prepare($sql_commande);
        $stmt_commande->bindParam(':nom_client', $nom_client);
        $stmt_commande->bindParam(':guichet_id', $guichet_id);
        $stmt_commande->execute();

        $commande_id = $conn->lastInsertId();

        $sql_article = "INSERT INTO articles_commande (commande_id, produit_id, quantite, prix) 
                        SELECT :commande_id, :produit_id, :quantite, :prix 
                        FROM produits 
                        WHERE id = :produit_id 
                        AND statut = 'actif'";
        $stmt_article = $conn->prepare($sql_article);

        foreach ($articles as $article) {
            $stmt_article->bindParam(':commande_id', $commande_id);
            $stmt_article->bindParam(':produit_id', $article['produit_id']);
            $stmt_article->bindParam(':quantite', $article['quantite']);
            $stmt_article->bindParam(':prix', $article['prix']);
            $stmt_article->execute();
        }

        $conn->commit();
        return true;

    } catch(PDOException $e) {
        $conn->rollback();
        return false; // Gérer l'erreur ici (optionnel)
    }
}

// Fonction principale pour la connexion à la base de données
$conn = connectToDatabase();

?>
