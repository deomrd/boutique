<?php
session_start();
include('include/config.php');

// Calcul du total des éléments

if(isset($_POST['btnsearch'])){
$date = prendre($_POST['search']);

$total_items_query = $bdd->prepare("SELECT COUNT(*) as total FROM factures WHERE paie != '' AND statut = 1 AND dateFac LIKE '%$date%'");
$total_items_query->execute();
$total_items_result = $total_items_query->fetch();
$total_items = $total_items_result['total'];
// Nombre d'éléments par page
$items_per_page = 10;

// Calcul du nombre de pages
$total_pages = ceil($total_items / $items_per_page);

// Récupération de la page courante
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max(1, min($page, $total_pages));

// Calcul de l'offset pour la requête SQL
$offset = ($page - 1) * $items_per_page;

// Récupération des éléments pour la page courante
$req = $bdd->prepare("SELECT * FROM factures WHERE paie != '' AND dateFac LIKE '%$date%' AND statut = 1 ORDER BY dateFac ASC LIMIT :offset, :limit");
$req->bindValue(':offset', $offset, PDO::PARAM_INT);
$req->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$req->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/title.php'); ?>
</head>

<body>
    <?php include('include/retour.php'); ?>
    <div id="wrapper">
        <div id="page-wrapper">
         
            <div class="form-container">

                   
                    <div >
                        <div class="alert">
                            <form action="" method="post" >
                                <!-- Informations du client -->
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="text" name="search" class="form-control" placeholder="27/04/2022">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="submit" name="btnsearch" class="btn btn-primary" value="Recherche">
                                    </div>
                                </div>
                            </form>
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
                                    if (isset($req) && $req->rowCount() > 0) {
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
                            <?php if (isset($total_items) && $total_items > 0) { ?>
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

                    <!-- Boutons d'action -->
                    <div class="row">
                        
                    </div>
                </form>
            </div>
        </div>
        <?php include('include/footer.php'); ?>
    </div>

    <!-- Inclusion de jQuery, jQuery UI et Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
</body>

</html>