<?php
session_start();
include('include/config.php');

// Nombre d'éléments par page
$items_per_page = 10;

// Calcul du total des éléments
$total_items_query = $bdd->prepare("SELECT COUNT(*) as total FROM factures WHERE paie = '' AND statut = 1");
$total_items_query->execute();
$total_items_result = $total_items_query->fetch();
$total_items = $total_items_result['total'];

// Calcul du nombre de pages
$total_pages = ceil($total_items / $items_per_page);

// Récupération de la page courante
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $total_pages));

// Calcul de l'offset pour la requête SQL
$offset = ($page - 1) * $items_per_page;

// Récupération des éléments pour la page courante
$req = $bdd->prepare("SELECT * FROM factures WHERE paie != '' AND statut = 1 ORDER BY dateFac ASC LIMIT :offset, :limit");
$req->bindValue(':offset', $offset, PDO::PARAM_INT);
$req->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$req->execute();
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
                <h2>TOUTES LES FACTURES </h2>
                <a href="bonnew" title="Ajouter un bon"><i class="fa fa-plus"></i></a>
            </div>
            <div class="alert">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>DATE</th>
                            <th>HEURE</th>
                            <th>NOM</th>
                            
                                <th>ACTIONS</th>
                           
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>DATE</th>
                            <th>HEURE</th>
                            <th>NOM</th>
                            
                                <th>ACTIONS</th>
                           
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        if ($req->rowCount() > 0) {
                            foreach ($req as $r) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($r['dateFac']); ?></td>
                                    <td><?= htmlspecialchars($r['heureFac']); ?></td>
                                    <td><?= htmlspecialchars($r['nomCl']); ?></td>
                                    
                                        <td>
                                            <a href="factureview?getid=<?= htmlspecialchars($r['idFac']); ?>&fac=<?= md5($r['idFac']); ?>" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                   
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="<?= ($priv == 1) ? 4 : 3 ?>" class="no-data">
                                    Aucune information actuellement.
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <!-- Pagination -->
                <?php if ($total_items > 0) { ?>
                    <div class="pagination">
                        <!-- Previous Button -->
                        <a href="?page=<?= $page - 1 ?>" class="<?= ($page == 1) ? 'disabled' : '' ?>">Précédent</a>

                        <?php
                        // Liens de pagination
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active_class = ($i == $page) ? 'active' : '';
                            echo "<a href='?page=$i' class='$active_class'>$i</a>";
                        }
                        ?>

                        <!-- Next Button -->
                        <a href="?page=<?= $page + 1 ?>" class="<?= ($page == $total_pages) ? 'disabled' : '' ?>">Suivant</a>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>
</body>

</html>
