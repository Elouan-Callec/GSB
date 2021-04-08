<?php

	// connexion à la base
	include "mesFonctionsGenerales.php";
	$cnxBDD = connexion();
	
	//Recupération des information saisies
	$num = trim($_GET['id']);
	//if($num){
	//Execution de la requête
	$sql = "DELETE FROM visiteurmedical WHERE id =$num;";
	print_r($sql);
	$result = $cnxBDD->query($sql);
	//}
	// Fermer la connexion MYSQL
	$cnxBDD->close();

	//Redirection en fonction du résultat de la requête
	if ($result){
		$_SESSION["Suppr"] = "<font color=green> Suppression realisee </font>";
		echo "<meta http-equiv='refresh' content='0;url=tmp_index.php'>";
	}/*
	else{
		$_SESSION["PbSuppr"] = "<font color=red>".erreurSQL()."</font>";
		echo "<meta http-equiv='refresh' content='0;url=index.php'>";
	}*/
	header('Location: interface.php');

	
?>



