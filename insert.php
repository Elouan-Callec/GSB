<?php 

// connexion à la base
include "mesFonctionsGenerales.php";
$cnxBDD = connexion();


//Infos du contact
$identifiant = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$adresse = $_GET['adresse'];
$ville = $_GET['adresse'];
$dateEmbauche = $_GET['dateEmbauche'];
$cp = $_GET['cp'];


//Execution de la requête
$sql = "INSERT INTO visiteurmedical (id,nom,prenom,adresse,ville,dateEmbauche,cp)
VALUES ('".$identifiant."','".$nom."','".$prenom."','".$adresse."',
'".$ville."','".$dateEmbauche."','".$cp."');";
$result = $cnxBDD->query($sql) or die (afficheErreur($sql, $cnxBDD->error_list[0]['error']));
	

// Fermer la connexion MYSQL
$cnxBDD->close();
		

//Redirection en fonction du résultat de la requête
if ($result){
	$_SESSION["Ajout"] = "<font color=green> Ajout réalisé </font>";
	echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}else{
	$_SESSION["Error"] = "<font color=red>".erreurSQL()."</font>";
	echo "<meta http-equiv='refresh' content='0;url=./FormContact.php'>";
}
?>