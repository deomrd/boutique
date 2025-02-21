<?php
session_start();
include('include/config.php');
$priv=onlyprincipal($_SESSION['priv'], 'produit');

// Récupérer les dates sélectionnées
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d');

// Calcul du total des éléments pour le cash
$total_cash_query = $bdd->prepare("SELECT SUM(df.quanProd * df.prix) as totalCash
                                    FROM factures f 
                                    JOIN detailfacture df ON f.idFac = df.idFac 
                                    WHERE DATE(STR_TO_DATE(f.dateFac, '%d/%m/%Y')) BETWEEN :start_date AND :end_date
                                    AND f.statut = 1 AND f.paie = 'cash'");
$total_cash_query->execute(['start_date' => $start_date, 'end_date' => $end_date]);
$total_cash_result = $total_cash_query->fetch();
$total_cash = $total_cash_result['totalCash'];

// Calcul du total des éléments pour la dette
$total_debt_query = $bdd->prepare("SELECT SUM(df.quanProd * df.prix) as totalDebt
                                   FROM factures f 
                                   JOIN detailfacture df ON f.idFac = df.idFac 
                                   WHERE DATE(STR_TO_DATE(f.dateFac, '%d/%m/%Y')) BETWEEN :start_date AND :end_date
                                   AND f.statut = 1 AND f.paie = 'dette'");
$total_debt_query->execute(['start_date' => $start_date, 'end_date' => $end_date]);
$total_debt_result = $total_debt_query->fetch();
$total_debt = $total_debt_result['totalDebt'];

// Calcul du total général
$total_items_query = $bdd->prepare("SELECT COUNT(*) as total 
                                    FROM factures 
                                    WHERE DATE(STR_TO_DATE(dateFac, '%d/%m/%Y')) BETWEEN :start_date AND :end_date
                                    AND statut = 1");
$total_items_query->execute(['start_date' => $start_date, 'end_date' => $end_date]);
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
$req = $bdd->prepare(
    "SELECT f.dateFac, f.nomCl, df.nomProd, df.quanProd, df.prix, f.paie 
    FROM factures f 
    JOIN detailfacture df ON f.idFac = df.idFac 
    WHERE DATE(STR_TO_DATE(f.dateFac, '%d/%m/%Y')) BETWEEN :start_date AND :end_date
    AND f.statut = 1 && f.paie !='' 
    ORDER BY f.dateFac ASC 
    LIMIT :offset, :limit"
);
$req->bindValue(':start_date', $start_date, PDO::PARAM_STR);
$req->bindValue(':end_date', $end_date, PDO::PARAM_STR);
$req->bindValue(':offset', $offset, PDO::PARAM_INT);
$req->bindValue(':limit', $items_per_page, PDO::PARAM_INT);
$req->execute();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('include/title.php'); ?>
    <style>
        /* Styles identiques à la page précédente */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(120deg, #40ab5e, #ff0000);
            margin: 0;
            padding: 0;
        }

        #wrapper {
            margin: 20px;
        }

        .header-title {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #4e4376;
            color: white;
            padding: 10px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            width: fit-content;
        }

        .header-title h2 {
            font-size: 1.6em;
            margin: 0;
        }

        .header-title a {
            border: 2px solid #ff6f61;
            border-radius: 50px;
            background: #ff6f61;
            padding: 8px 12px;
            color: white;
            text-decoration: none;
        }

        .header-title a:hover {
            background: #ff4a34;
        }

        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 1.1em;
        }

        .table th {
            background-color: #4e4376;
            color: white;
        }

        .table td {
            background-color: #f9f9f9;
            color: #333;
        }

        .table tr:nth-child(even) td {
            background-color: #f2f2f2;
        }

        .table tr:hover td {
            background-color: #ddd;
        }

        .table .bg-cash {
            background-color: #28a745 !important; /* Vert pour le cash */
            color: white !important;
            font-weight: bold;
        }

        .table .bg-debt {
            background-color: #dc3545 !important; /* Rouge pour la dette */
            color: white !important;
            font-weight: bold;
        }

        .alert {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            text-decoration: none;
            background-color: #4e4376;
            color: white;
            border-radius: 5px;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }

        .pagination a:hover {
            background-color: #3f355b;
            transform: translateY(-2px);
        }

        .pagination .active {
            background-color: #3f355b;
            pointer-events: none;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            font-size: 18px;
            color: #888;
        }

        .totals {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }

        .date-selector {
            margin-bottom: 20px;
        }

        .date-selector label {
            font-weight: bold;
            margin-right: 10px;
        }

        .date-selector input {
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .date-selector button {
            padding: 5px 10px;
            background-color: #4e4376;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .date-selector button:hover {
            background-color: #3f355b;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header-title">
                <h2>Rapport par Intervalle de Dates</h2>
            </div>
            <div class="date-selector">
                <form method="GET" action="">
                    <label for="start_date">Date de début :</label>
                    <input type="date" name="start_date" id="start_date" value="<?= $start_date ?>" style="color: black;">
                    <label for="end_date">Date de fin :</label>
                    <input type="date" name="end_date" id="end_date" value="<?= $end_date ?>" style="color: black;">
                    <button type="submit">Filtrer</button>
                </form>
            </div>

            <div class="totals">
                <div>Total en Cash : <span class="bg-cash"><?= number_format($total_cash, 2, ',', ' ') ?> $</span></div>
                <div>Total en Dette : <span class="bg-debt"><?= number_format($total_debt, 2, ',', ' ') ?> $</span></div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix</th>
                        <th>Mode de Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($req->rowCount() > 0) {
                        while ($row = $req->fetch()) {
                            $payment_class = $row['paie'] === 'cash' ? 'bg-cash' : 'bg-debt';
                            echo "
                            <tr>
                                <td>{$row['dateFac']}</td>
                                <td>{$row['nomCl']}</td>
                                <td>{$row['nomProd']}</td>
                                <td>{$row['quanProd']}</td>
                                <td>" . number_format($row['prix'], 2, ',', ' ') . "</td>
                                <td class='{$payment_class}'>{$row['paie']}</td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='no-data'>Aucune donnée disponible pour cet intervalle de dates</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    echo "<a href='?start_date=$start_date&end_date=$end_date&page=$i' class='" . ($page == $i ? 'active' : '') . "'>$i</a>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>