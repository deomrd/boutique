<?php

	function bdd($host, $db, $user, $pass){
		try{
			$bdd=new PDO("mysql:host=$host; dbname=$db", $user, $pass);
			return $bdd;
			
		}
		catch(PDOException $e){
			return "Erreur :".$e->getMessage();

		}

	}

	function connexion($bdd, $table, $isset, $user, $pass, $statut ){
		if (isset($_POST['login'])) {
			$user1=htmlspecialchars(trim($_POST['username']));
			$pass1=htmlspecialchars(trim($_POST['password']));
			$pass1=sha1(md5($pass1));

			$req=$bdd->query("SELECT * FROM $table WHERE $user='$user1' && $pass='$pass1' && $statut=1 ");
			return $req;


		}
	}

	function fetch($requete){
		return $res=$requete->fetch();
	}
	function nombre ($requete){
		return $res=$requete->rowcount();
	}

	function resultat($bdd, $table, $cond, $val){
		$requete=$bdd->query("SELECT * FROM $table WHERE $cond = '$val'");
		return $res=$requete->fetch();
	}

	function session ($bdd, $table, $cond, $val){
		if (empty($val)) {
			header('location:login');
		}else{
			$requete=$bdd->query("SELECT * FROM $table WHERE $cond = '$val' && statut=1");
			$req=nombre($requete);
			if($req==1){
				return $val;
			}else{
				header('location:login');
			}
		}
	}
	function onlyprincipal ($val, $lien){
		if ($val===0) {
			header('location:'.$lien);
		}else{
			return $val;
		}
	}

	function envoi($isset){
		return connexion();
	}

	function getAll($bdd, $table){
		$req=$bdd->query("SELECT * FROM $table");
		return $req;
	}
	function getOrd($bdd, $table, $arg1, $arg2){
		$req=$bdd->query("SELECT * FROM $table ORDER BY $arg1 $arg2");
		return $req;
	}

	function getBy1ord($bdd, $table, $arg1, $arg2, $arg3, $arg4){
		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' ORDER BY $arg3 $arg4");
		return $req;
	}

	function getBy2ord($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6){
		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' ORDER BY $arg5 $arg6");
		return $req;
	}

	function getByDbTb1($bdd, $table1, $table2, $arg1, $arg2){
		$req=$bdd->query("SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$arg1 = $table2.$arg2");
		return $req;
	}
	function getByDbTb2($bdd, $table1, $table2, $arg1, $arg2, $arg3){
		$req=$bdd->query("SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$arg1 =  $table2.$arg1 WHERE $table1.$arg2='$arg3'");
		// SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$arg1 =  $table2.$arg1 WHERE $table1.$arg2='$arg3'
		return $req;
	}
	function getByDbTb3($bdd, $table1, $table2, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6){
		$req=$bdd->query("SELECT * FROM $table1 INNER JOIN $table2 ON $table1.$arg1 = $table2.$arg2 WHERE $table1.$arg3='$arg4' && $table2.$arg5='$arg6'");
		return $req;
	}

 	function getBy1( $bdd, $table, $arg1, $arg2){
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2'");
 		return $req;
 	}
 	function getBy2( $bdd, $table, $arg1, $arg2, $arg3, $arg4){
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4'");
 		return $req;
 	}
 	function getBy3( $bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6) {
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' && $arg5='$arg6'");
 		return $req;
 	}
 	function getBy4( $bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8) {
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' && $arg5='$arg6' && $arg7='$arg8'");
 		return $req;
 	}

 	function getBy5( $bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10) {
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' && $arg5='$arg6' && $arg7='$arg8' && $arg9='$arg10'");
 		return $req;
 	}

 	function getBy6( $bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12) {
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' && $arg5='$arg6' && $arg7='$arg8' && $arg9='$arg10' && $arg11='$arg12'");
 		return $req;
 	}

 	function getBy7( $bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14) {
 		$req=$bdd->query("SELECT * FROM $table WHERE $arg1='$arg2' && $arg3='$arg4' && $arg5='$arg6' && $arg7='$arg8' && $arg9='$arg10' && $arg11='$arg12' && $arg13='$arg14'");
 		return $req;
 	}

 	function setBy1($bdd, $table, $arg1){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1')");
 		return $req;
 	}

 	function setBy2($bdd, $table, $arg1, $arg2){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2')");
 		return $req;
 	}
 	function setBy3($bdd, $table, $arg1, $arg2, $arg3){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3')");
 		return $req;
 	}
 	function setBy4($bdd, $table, $arg1, $arg2, $arg3, $arg4){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4')");
 		return $req;
 	}
 	function setBy5($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5')");
 		return $req;
 	}
 	function setBy6($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6')");
 		return $req;
 	}
 	function setBy7($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7')");
 		return $req;
 	}
 	function setBy8($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8')");
 		return $req;
 	}
 	function setBy9($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9')");
 		return $req;
 	}
 	function setBy10($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10')");
 		return $req;
 	}
 	function setBy11($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11')");
 		return $req;
 	}
 	function setBy12($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12')");
 		return $req;
 	}
 	function setBy13($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13')");
 		return $req;
 	}
 	function setBy14($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14')");
 		return $req;
 	}
 	function setBy15($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15')");
 		return $req;
 	}
 	function setBy16($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16')");
 		return $req;
 	}
 	function setBy17($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16, $arg17){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16', '$arg17')");
 		return $req;
 	}
 	function setBy18($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16, $arg17, $arg18){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16', '$arg17', '$arg18')");
 		return $req;
 	}
 	function setBy19($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16, $arg17, $arg18, $arg19){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16', '$arg17', '$arg18', '$arg19')");
 		return $req;
 	}
 	function setBy20($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16, $arg17, $arg18, $arg19, $arg20){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16', '$arg17', '$arg18', '$arg19', '$arg20')");
 		return $req;
 	}
 	function setBy21($bdd, $table, $arg1, $arg2, $arg3, $arg4, $arg5, $arg6, $arg7, $arg8, $arg9, $arg10, $arg11, $arg12, $arg13, $arg14, $arg15, $arg16, $arg17, $arg18, $arg19, $arg20, $arg21){
 		$req=$bdd->query("INSERT INTO $table VALUES('$arg1', '$arg2', '$arg3', '$arg4', '$arg5', '$arg6', '$arg7', '$arg8', '$arg9', '$arg10', '$arg11', '$arg12', '$arg13', '$arg14', '$arg15', '$arg16', '$arg17', '$arg18', '$arg19', '$arg20', '$arg21)");
 		return $req;
 	}

 	function nbrCl($bdd, $table, $cond){
 		$req=$bdd->query("SELECT COUNT(DISTINCT($cond)) FROM $table WHERE statut=1");
 		$r=fetch($req);
 		return $r[0];
 	}



 	function nbrTot($bdd, $table){
 		$req=getBy1($bdd, $table, 'statut', 1);
 		$r=nombre($req);
 		return $r;
 	}

 	function prendre ($var){
 		return $req=nl2br(htmlspecialchars(htmlentities(trim(addslashes($var)))));
 	}

 	 function mdp ($var){
 		return $var=sha1(md5(prendre($var)));
 	}

 	function verificationurl($bdd, $table, $identifiant, $valeur1, $valeur2, $lien){

 		if(isset($valeur1) && isset($valeur2) && md5($valeur1)===$valeur2){
 			$req=getBy2($bdd, $table, $identifiant, $valeur1, 'statut', 1);
 			// var_dump($req); exit;
	 		if(nombre($req)===0){
	 			header('location: '.$lien);
	  		}else{
	  			return fetch($req);
	  		}
 		}else{
 			header('location: '.$lien);
 		}
 		
 	}

 	function existanceBdd($bdd, $table, $identifiant, $valeur, $lien){
 		$req=getBy2($bdd, $table, $identifiant, $valeur, 'statut', 1);
 		if(nombre($req)===0){
 			header('location: '.$lien);
  		}else{
  			return fetch($req);
  		}
 	}