<?php

if (isset($_SESSION['priv'])) {
	$priv=$_SESSION['priv'];
}

// connecter
if (isset($_POST['login'])) {
	$user1=prendre($_POST['username']);
	$pass1=prendre($_POST['password']);
	$pass1=sha1(md5($pass1));

	// $req=$bdd->query("SELECT * FROM admins WHERE username='$user1' && password='$pass1' && statut=1 ");
	$req=getBy3($bdd, 'admin', 'username', $user1, 'password', $pass1, 'statut', 1);
	$r=$req->rowcount();
	if ($r==1) {
		$ss=$req->fetch();
		$_SESSION['admiD']=$ss['idAdmin'];
		$_SESSION['priv']=$ss['priv'];
		header('location: index');

	}else{
		$erreur="Mauvais identifiants.";
	}
}

//  enregistrer une recette

if (isset($_POST['envoyer'])) {

	if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['prix']) ) {
		
		$nom=prendre($_POST['nom']);
		$prix=prendre($_POST['prix']);

		if ($prix>0) {
			$ver=getBy2($bdd, 'recettes', 'nomRec', $nom, 'statut', 1);
			$v=nombre($ver);

			if ($v==0) {
				$req=setBy4($bdd, 'recettes', '', $nom, $prix, 1);
				if ($req) {
					$erreur="<div class='text-success'>Recette ajoutée avec succès.</div>";
				}else{
					$erreur="<div div class='text-danger'>Une erreur s'est produite. Ressayez de nouveau.</div>";
				}
			}else{
				$erreur="<div div class='text-danger'>Cette recette a déjà été enregistrée.</div>";
			}
		}else{
			$erreur="<div div class='text-danger'>Le prix doit dépasser 0</div>";
		}
	}else{
		$erreur="<div div class='text-danger'>Un ou plusieurs champs obligatoires sont vides.</div>";
	}
}




//  renforcer le stock


if (isset($_POST['ravitailler'])) {
	$prod=prendre($_POST['prod']); $qtt=prendre($_POST['qtt']); 

	if (!empty($prod) &&  !empty($qtt)) {
		if ($qtt>0) {
			$ver=getBy2($bdd, 'produits', 'statut', 1, 'idProd', $prod);
			if($v=nombre($ver)==1){
				$f=fetch($ver);
				$qtt1=$qtt+$f['quantite'];
				// historique des approvisionnements
				$day=date('d/m/y');
				$stock=setBy5($bdd, 'stock', '', $prod, $day, $qtt, 1);
				$req=$bdd->query("UPDATE produits SET quantite='$qtt1' WHERE idProd='$prod'");
				if($req){
					header('location:produit');
				}else{
					$erreur="<div>Une erreur s'est produite. Veillez ressayer.</div>";
				}
				
			}else{
				$erreur="<div>Impossible de renforcer ce produit ou il est déjà renforcé.</div>";
			}
		}else{
			$erreur="<div>La quantité doivent etre supérieure à 0.</div>";
		}
	}else{
		$erreur="<div>Tous les champs sont obligatoires.</div>";
	}
}



// enregistrer une facture

if (isset($_POST['createfac'])) {

	if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['serveur']) && !empty($_POST['serveur']) ) {
		
		$nom=prendre($_POST['nom']);
		$server=prendre($_POST['serveur']);
		$day=date('d/m/Y');
		$heure=date('H:i');


		$req=setBy8($bdd, 'factures', '', $nom, $day, $heure, $server, 0, '', 1);
		if ($req) {
			$last=$bdd->lastInsertId();

			header('location:addfac?getid='.md5($last)."&&tac=".$last);

		}else{
			$erreur="<div class='text text-danger'>Une erreur s'est produite. Ressayez de nouveau.</div>";
		}
		
	}else{
		$erreur="<div class='text text-danger'>Un ou plusieurs champs obligatoires sont vides.</div>";
	}
}






// connecter un utilisateur

if (isset($_POST['usernew'])) {
	$nom=prendre($_POST['nom']);
	$postnom=prendre($_POST['postnom']);
	$nom = $nom . ' ' . $postnom;
	$username=prendre($_POST['username']);
	$phone=prendre($_POST['phone']);
	$adresse=prendre($_POST['adresse']);
	$password=prendre($_POST['password']);
	// var_dump($password); exit;
	if (!empty($nom) && !empty($username) && !empty($phone) && !empty($password)) {
		$pass=sha1(md5($password));
		$req=getBy2($bdd, 'admin', 'statut', 1, 'username', $username);
		$r=nombre($req);
		if ($r==0) {
			$ins=setBy8($bdd, 'admin', '', $nom, $phone, $adresse, $username, $pass, 0, 1);
			if ($ins) {
					header('location: param_users');
			}else{
				$erreur= "Une erreur s\'est produite. Veillez ressayer.;";
			}
		}else{
			$erreur= "Ce nom d'utilisateur est déjà dans le système.;";
		}
	}else{
		$erreur= "Certains champs obligatoires sont vides.;";
	}
}

// creer un utilisateur
if (isset($_POST['signup'])) {
	$nom=prendre($_POST['nom']);
	$postnom=prendre($_POST['postnom']);
	$nom = $nom . ' ' . $postnom;
	$username=prendre($_POST['username']);
	$phone=prendre($_POST['phone']);
	$adresse=prendre($_POST['adresse']);
	$password=prendre($_POST['password']);
	// var_dump($password); exit;
	if (!empty($nom) && !empty($username) && !empty($phone) && !empty($password)) {
		$pass=sha1(md5($password));
		$req=getBy2($bdd, 'admin', 'statut', 1, 'username', $username);
		$r=nombre($req);
		if ($r==0) {
			$ins=setBy8($bdd, 'admin', '', $nom, $phone, $adresse, $username, $pass, 1, 1);
			if ($ins) {
					$erreur= "<span  style='color : green'>Utilisateur créé avec succès. Veuillez vous connecter.";
					$_POST['nom']=''; $_POST['postnom']=''; $_POST['adresse']=''; $_POST['phone']=''; $_POST['username']=''; $_POST['password']='';
			}else{
				$erreur= "Une erreur s\'est produite. Veillez ressayer.";
			}
		}else{
			$erreur= "Ce nom d'utilisateur est déjà dans le système.";
		}
	}else{
		$erreur= "Certains champs obligatoires sont vides.";
	}
}

// modifier un utilisateur

if (isset($_POST['moduser'])) {
	$nom=prendre($_POST['nom']);
	$username=prendre($_POST['username']);
	$phone=prendre($_POST['phone']);
	$adresse=prendre($_POST['adresse']);
	$user=prendre($_POST['user']);
	if (!empty($nom) && !empty($username) && !empty($phone) && !empty($adresse) && !empty($user)) {


		$ins=$bdd->query("UPDATE admin SET nom='$nom', phoneAdmin='$phone', adresseAdmin='$adresse', username='$username' WHERE idAdmin='$user' && statut=1");
		if ($ins) {
			header('location: users');
		}else{
			echo "<script> alert('Une erreur s\'est produite. Veillez ressayer.'); </script>";
		}
		
	}else{
		echo "<script> alert('Tous les champs sont obligatoires.'); </script>";
	}
}

//  enregistrer un mbegeti

if (isset($_POST['addmbeg'])) {

	if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['nombre']) && !empty($_POST['nombre']) && isset($_POST['produit']) && !empty($_POST['produit'])) {
		
		$nom=prendre($_POST['nom']);
		$prix=prendre($_POST['prix']);
		$nombre=prendre($_POST['nombre']);
		$produit=prendre($_POST['produit']);

		if ($prix>0) {
			$ver=getBy2($bdd, 'mbegeti', 'nomMbeg', $nom, 'statut', 1);
			$v=nombre($ver);

			if ($v==0) {
				$req=setBy6($bdd, 'mbegeti', '', $nom, $prix, $produit, $nombre, 1);
				if ($req) {
					$erreur="<div class='text-success'>Mbegeti ajouté avec succès.</div>";
				}else{
					$erreur="<div div class='text-danger'>Une erreur s'est produite. Ressayez de nouveau.</div>";
				}
			}else{
				$erreur="<div div class='text-danger'>Ce mbegeti a déjà été enregistré.</div>";
			}
		}else{
			$erreur="<div div class='text-danger'>Le prix doit dépasser 0</div>";
		}
	}else{
		$erreur="<div div class='text-danger'>Un ou plusieurs champs obligatoires sont vides.</div>";
	}
}

// modifier un mbegeti
if (isset($_POST['modmbeg'])) {

	if (isset($_POST['nom']) && isset($_POST['prix']) && isset($_POST['mbeg']) ) {
		
		$nom=prendre($_POST['nom']);
		$mbeg=prendre($_POST['mbeg']);
		$prix=prendre($_POST['prix']);
		$nbr=prendre($_POST['nbr']);


		if ($prix>0) {
				$req=$bdd->query("UPDATE mbegeti SET nomMbeg='$nom', prixMbeg='$prix', bouteilles='$nbr' WHERE idMbeg='$mbeg' && statut=1");
				if ($req) {
					header('location: mbegetis');
				}else{
					$erreur="<div div class='text-danger'>Une erreur s'est produite. Ressayez de nouveau.</div>";
				}
		}else{
			$erreur="<div div class='text-danger'>Le prix doit dépasser 0</div>";
		}
	}else{
		$erreur="<div div class='text-danger'>Un ou plusieurs champs obligatoires sont vides.</div>";
	}
}

// facture mbegeti



// ajouter mbegeti sur facture

if (isset($_POST['addfacm'])) {
	if (isset($_POST['mbeg']) && isset($_POST['quant']) && isset($_POST['fac']) ) {
		$prod=prendre($_POST['mbeg']);
		$quant=prendre($_POST['quant']);
		$fac=prendre($_POST['fac']);
		$devise=prendre($_POST['devise']);

		// trouver si le produit qui est sur mbegeti dans le stock
		$produit=resultat($bdd, 'mbegeti', 'idMbeg', $prod);
		$idProd=$produit['produit'];
		$bout=$produit['bouteilles']*$quant;

		$trouver=resultat($bdd, 'boisson', 'idProd', $idProd);
		$qttProd=$trouver['quanProd'];

		$nom=$produit['nomMbeg'];
		$prix=$produit['prixMbeg'];

		// si le mbegeti n'est pas encore sur la facture

		$req=getBy3($bdd, 'detailfacture', 'idSot', $prod, 'statut', 1, 'idFac', $fac);
		$nr=nombre($req);
		if ($nr==0) {
			// verifer si le stock est en mesure
			if ($bout<=$qttProd) {
				// entrer les donnees et retirer la quantite dans le stock
				$reste=$qttProd-$bout;

				$insert=setBy8($bdd, 'detailfacture', '', $fac, $prod, $nom, $prix, $quant, $devise, 1);
				$update=$bdd->query("UPDATE boisson SET quanProd='$reste' WHERE idProd='$idProd'");

				if($update){
					$erreurm="<div class='text text-success'>Ajouté avec succès.</div>";
				}else{
					$erreurm="<div class='text text-danger'>Une erreur s'est produite. Veillez ressayer.</div>";
				}

			}else{
				$erreurm="<div class='text text-danger'>Ces produits sont finis dans le stock.</div>";
			}
		}else{
			// ajouter la quantite sur la facture
			//  verifier dans le stock

			if($bout<=$qttProd){
				$reste1=$qttProd-$bout;
				$r=fetch($req);
				$qttAct=$r['quanProd'];
				$vrqtt=$quant+$qttAct;
				$update=$bdd->query("UPDATE detailfacture SET quanProd = '$vrqtt' WHERE idSot='$prod'");
				$upd=$bdd->query("UPDATE boisson SET quanProd='$reste1' WHERE idProd='$idProd'");

				if ($upd) {
					$erreurm="<div class='text text-success'>Ajouté avec succès.</div>";
				}
			}else{
				$erreurm="<div class='text text-danger'>La quantité demandée n'est plus dans le stock.</div>";
			}
		}

		
	}else{
		$erreurm="<div class='text text-danger'>Tous les champs sont obligatoires.</div>";
	}
}


// retirer un produit


// fermer une facture



// fermer la facture combinee

if (isset($_POST['fermer'])) {
	$fac=prendre($_POST['fac']);
	$ver=getBy2($bdd, 'detailfacture', 'idFac', $fac, 'statut', 1);
	$v=nombre($ver);
	if ($v==0) {
		$erreur="<div>Placez au moins un produit sur cette facture pour fermer.</div>";
	}else{
		$mod=$bdd->query("UPDATE factures SET etat=1 WHERE idFac='$fac'");
		header('location: bon?fac='.md5($fac)."&&getid=".$fac);
	}
}


// modifier les identifiants

if (isset($_POST['update'])) {
	$user1=prendre($_POST['user1']);
	$mdp1=mdp($_POST['mdp1']);
	$user2=prendre($_POST['user2']);
	$mdp2=mdp($_POST['mdp2']);

	if (!empty($user1) && !empty($_POST['mdp1']) && !empty($user2) && !empty($_POST['mdp2']) ) {
		$req=getBy4($bdd, 'admin', 'username', $user1, 'password', $mdp1, 'statut', 1, 'idAdmin', $idession);
		$r=nombre($req);
		if ($r==1) {
			if (strlen($_POST['mdp2']>=8)) {
				$mod=$bdd->query("UPDATE admin SET username='$user2', password='$mdp2' WHERE idAdmin='$idession'");
				if ($mod) {
					header('location: login');
				}else{
					$erreur="<div>Une erreur s'est produite, veuillez ressayer.</div>";
				}
			}else{
				$erreur="<div>Mot de passe court, tapez au moins 8 caractères.</div>";
			}
		}else{
			$erreur="<div>Mauvais identifiants.</div>";
		}
	}else{
		$erreur="<div>Tous les champs sont obligatoires.</div>";
	}
}


// payer une facture 


if (isset($_POST['payer'])) {
	if(isset($_POST['fac']) && isset($_POST['prix'])){
	$fac=prendre($_POST['fac']);
	$prix=prendre($_POST['prix']);
	$day=date('d/m/Y');
		$verification=getBy2($bdd, 'dettes', 'statut', 1, 'fac', $fac);
		// var_dump($verification); exit;
		if(nombre($verification)==1){
			$ver=fetch($verification);
			$somme=$ver['somme'];
			$reste=$somme-$prix;
			if($reste<0){
				$erreur="<div class='text text-danger'>Le paiement est supérieur à la dette.</div>";
			}elseif($reste==0){
				$req=$bdd->query("UPDATE dettes SET statut=0 WHERE fac='$fac' && statut=1");
				$requete=$bdd->query("UPDATE factures SET paie='Cash', dateFac='$day' WHERE idFac='$fac' && statut=1");
				header('location: fac?fac='.md5($fac)."&&getid=".$fac);
			}else{
				$req=$bdd->query("UPDATE dettes SET somme='$prix' WHERE fac='$fac' && statut=1");
				header('location: fac?fac='.md5($fac)."&&getid=".$fac);
			}
		}else{ header('location: facture');}
	}else{
		$erreur="<div class='text text-danger'>Certains champs sont vides.</div>";
	}
}


// create un produit

if (isset($_POST['create'])) {

	if (isset($_POST['nom']) && !empty($_POST['nom']) && isset($_POST['prix']) && !empty($_POST['prix']) && isset($_POST['unite']) && !empty($_POST['unite'])) {
		
		$nom=prendre($_POST['nom']);
		$prix=prendre($_POST['prix']);
		$unite=prendre($_POST['unite']);

		if ($prix>0) {
			$ver=getBy2($bdd, 'produits', 'nomProd', $nom, 'statut', 1);
			$v=nombre($ver);

			if ($v==0) {
				$req=setBy6($bdd, 'produits', '', $nom, $prix, $unite, 0, 1);
				if($req){
					header('location: produit');
				}else{
					$erreur="Une erreur s'est produite. Veillez ressayer.";
				}
				
			}else{
				$erreur="Ce produit a déjà été enregistré.";
			}
		}else{
			$erreur="Le prix doit dépasser 0";
		}
	}else{
		$erreur="Un ou plusieurs champs obligatoires sont vides.";
	}
}


// creer un serveur 

if (isset($_POST['envoyerServeur'])) {
	$nom=prendre($_POST['nom']);
	if (!empty($nom)) {
		
		$req=getBy2($bdd, 'serveurs', 'statut', 1, 'nomServ', $nom);
		$r=nombre($req);
		if ($r==0) {
			$ins=setBy3($bdd, 'serveurs', '', $nom, 1);
			if ($ins) {
					echo "<script> alert('Serveur est enregistré avec succès.'); </script>";
			}else{
				echo "<script> alert('Une erreur s\'est produite. Veillez ressayer.'); </script>";
			}
		}else{
			echo "<script> alert('Ce serveur est déjà dans le système.'); </script>";
		}
	}else{
		echo "<script> alert('Tous les champs sont obligatoires.'); </script>";
	}
}