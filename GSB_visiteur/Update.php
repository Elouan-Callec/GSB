<?php

// connexion à la base
//include "mesFonctionsGenerales.php";
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

$sql = "UPDATE visiteurmedical
		SET id = \"$identifiant\",
			nom = \"$nom\",
			prenom = \"$prenom\",
			adresse =\"$adresse\",
			ville =\"$ville\",
			cp =\"$cp\",
			dateEmbauche =\"$dateEmbauche\",
			login =\"$login\",
			mdp =\"$mdp\"
		WHERE id = \"$identifiant\"";

//$result = $cnxBDD->query($sql);

$result = $cnxBDD->query($sql) or die (afficheErreur($sql, $cnxBDD->error_list[0]['error']));

// Fermer la connexion MYSQL
$cnxBDD->close();

if ($result){
	$_SESSION["Modif"] = "<font color=green>Modification realisee</font>";
	echo "<meta http-equiv='refresh' content='0;url=interface.php'>";
}else {
	$_SESSION["Error"] = "<font color=red>".erreurSQL()."</font>";
	echo "<meta http-equiv='refresh' content='0;url=FormContact.php?BOmodif=".$num."'>";
}

?>



