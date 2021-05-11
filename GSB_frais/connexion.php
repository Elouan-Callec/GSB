<?php

include "mesFonctionsGenerales.php";

$cnxBDD = connexion();

$sql = "SELECT login, mdp 
        FROM visiteurmedical
        WHERE login = ".$_GET['login']." AND mdp = ".$_GET['password'].";";

$result = $cnxBDD->query($sql);
//$maLigne = $result->fetch_assoc();

//$result = $cnxBDD->query($sql);

$result = $cnxBDD->query($sql) or die ("Login ou mot de passe incorrect");

// Fermer la connexion MYSQL
$cnxBDD->close();

if ($result){
	//$_SESSION["Modif"] = "<font color=green>Modification realisee</font>";
	echo "<meta http-equiv='refresh' content='0;url=interface.php'>";
}
?>