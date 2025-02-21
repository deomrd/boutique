<?php 
session_start(); 
include('include/config.php');

// Nombre d'éléments par page
$items_per_page = 10;

// Calcul du total des éléments
$total_items_query = $bdd->query("SELECT COUNT(*) as total FROM produits WHERE statut=1");
$total_items_result = $total_items_query->fetch();
$total_items = $total_items_result['total'];

// Calcul du nombre de pages
$total_pages = ceil($total_items / $items_per_page);

// Récupération de la page courante
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
if ($page > $total_pages) $page = $total_pages;

// Calcul de l'offset pour la requête SQL
$offset = ($page - 1) * $items_per_page;

// Récupération des éléments pour la page courante
if($total_items >0){
$req = $bdd->query("SELECT * FROM produits WHERE statut=1 ORDER BY nomProd ASC LIMIT $offset, $items_per_page");}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header-title">
                <h2>TOUS LES PRODUITS <?php if($priv == 1) { ?> <a href="produitajouter" title="Ajouter un produit"><i class="fa fa-plus -circle"></i></a></h2> <?php } ?>
                
            </div>
            <div class="alert">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="text-align: center;">LIBELLE</th>
                            <th style="text-align: center;">PRIX U</th>
                            <th style="text-align: center;">QUANTITE</th>
                            <?php if($priv == 1) { ?>
                                <th style="text-align: center;">ACTIONS</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if(isset($req)){


                        foreach ($req as $r) {
                            ?>
                            <tr>
                                <td><?= $r['nomProd'] ?></td>
                                <td><?= $r['prix'] ?> $</td>
                                <td><?= $r['quantite'] ?> <?= $r['unite'] ?></td>
                                <?php if($priv == 1) { ?>
                                    <td>
                                        <a href="produitravitailler?gerec=<?= md5($r['idProd']) ?>&&getid=<?= $r['idProd'] ?>" class=""><i class="fa fa-truck"></i></a> ||
                                        <a href="produitmodifier?getid=<?= md5($r['idProd']) ?>&&gerec=<?= $r['idProd'] ?>" class=""><i class="fa fa-pencil"></i></a> ||
                                        <a href="delete?getid=<?= md5($r['idProd']) ?>&&gerec=<?= $r['idProd'] ?>" class=""><i class="fa fa-times-circle"></i></a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } }else{
                            echo "Aucune donnée disponible";
                        }?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <!-- Previous Button -->
                    <a href="?page=<?= $page - 1 ?>" class="prev <?= ($page == 1) ? 'disabled' : '' ?>">Précédent</a>

                    <?php
                    // Affichage des liens de pagination
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $active_class = ($i == $page) ? 'active' : '';
                        echo "<a href='?page=$i' class='$active_class'>$i</a>";
                    }
                    ?>

                    <!-- Next Button -->
                    <a href="?page=<?= $page + 1 ?>" class="next <?= ($page == $total_pages) ? 'disabled' : '' ?>">Suivant</a>
                </div>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
