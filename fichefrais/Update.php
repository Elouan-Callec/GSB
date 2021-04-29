<?php

// connexion à la base
include "mesFonctionsGenerales.php";
$cnxBDD = connexion();

//Infos du contact
$identifiant = $_GET['id'];
$idVisiteur = $_GET['idVisiteur'];
$mois = $_GET['mois'];
$annee = $_GET['annee'];
$nbJustificatifs = $_GET['nbJustificatifs'];
$montantValide = $_GET['montantValide'];
$idEtat = $_GET['idEtat'];

$sql = "UPDATE fichefrais
		SET id = \"$identifiant\",
			idVisiteur = \"$idVisiteur\",
			mois = \"$mois\",
			annee =\"$annee\",
			nbJustificatifs =\"$nbJustificatifs\",
			montantValide =\"$montantValide\",
			dateModif =\"$dateModif\",
			idEtat =\"$idEtat\"
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



