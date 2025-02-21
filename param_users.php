<?php
session_start();
include('include/config.php');

$users= getBy1ord($bdd, 'admin', 'statut', 1, 'nom', 'ASC');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('include/title.php'); ?>

</head>

<body>
    <div id="wrapper">
        <?php include('include/retour.php'); ?>
        <div id="page-wrapper">
            <div class="header">
                <h2>GESTION DES UTILISATEURS</h2>
                <p>Bienvenue, <?= $res['nom']; ?>!</p>
            </div>
            <div class="alert">
                <strong>Liste des utilisateurs enregistrés :</strong>
            </div>

            <!-- Tableau des utilisateurs -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Nom d'utilisateur</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr style="color: black;">
                                <td><?= $user['nom']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['phoneAdmin']; ?></td>
                                <td><?= $user['adresseAdmin']; ?></td>
                                <td>
                                    <?php
                                        if($user['priv']==1){
                                    ?>
                                    Admin principal
                                    <?php
                                        }else{
                                            echo "Admin secondaire";
                                        }
                                    ?>
                                </td>
                                <!-- <td> -->
                                    <!-- Boutons d'actions -->
                                    <!-- <a href="edit_user?id=<?= $user['id']; ?>" class="btn btn-primary btn-sm"> -->
                                  <!--       <i class="fa fa-pencil"></i> Modifier
                                    </a>
                                    <a href="delete_user.php?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                        <i class="fa fa-trash"></i> Supprimer
                                    </a> -->
                                <!-- </td> -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bouton Ajouter un utilisateur -->
            <div class="text-right">
                <a href="usernew" class="btn btn-success">
                    <i class="fa fa-user-plus"></i> Ajouter un utilisateur
                </a>
            </div>
        </div>
        <footer>
            © <?= date('Y'); ?> Votre entreprise - Tous droits réservés.
        </footer>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>

</html>
