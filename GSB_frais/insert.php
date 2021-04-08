<?php 

// connexion à la base
include "mesFonctionsGenerales.php";
$cnxBDD = connexion();


//Infos du contact
$identifiant = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$adresse = $_GET['adresse'];
$ville = $_GET['ville'];
$dateEmbauche = $_GET['dateEmbauche'];
$cp = $_GET['cp'];
$login = $_GET['login'];
$mdp = $_GET['mdp'];


//Execution de la requête
$sql = "INSERT INTO visiteurmedical (nom,prenom,adresse,ville,dateEmbauche,cp,login,mdp)
VALUES ('".$nom."','".$prenom."','".$adresse."',
'".$ville."','".$dateEmbauche."','".$cp."','".$login."','".$mdp."');";
$result = $cnxBDD->query($sql) or die (afficheErreur($sql, $cnxBDD->error_list[0]['error']));
	

// Fermer la connexion MYSQL
$cnxBDD->close();
		

//Redirection en fonction du résultat de la requête
if ($result){
	$_SESSION["Ajout"] = "<font color=green> Ajout réalisé </font>";
	echo "<meta http-equiv='refresh' content='0;url=interface.php'>";
}else{
	$_SESSION["Error"] = "<font color=red>".erreurSQL()."</font>";
	echo "<meta http-equiv='refresh' content='0;url=./FormContact.php'>";
}
?>