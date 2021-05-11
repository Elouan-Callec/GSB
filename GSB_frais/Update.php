<?php 

include "mesFonctionsGenerales.php";

// connexion à la base de donnée
$cnxBDD = connexion();

//declaration des variables

$mois = $_GET['mois'];
$annee = $_GET['annee'];
$dte = date("Y-m-d");
$repasmidi = $_GET['repasmidi'];
$nuitees = $_GET['nuitees'];
/*$etape = $_GET['etape'];
$km=$_GET['km'];*/
$totalrepas=$repasmidi*getForfait('REP');
$totalnuitees=$nuitees*getForfait('NUI');
/*$totaletape=$etape*5;
$totalkm=$km*getForfait('K4E');*/

//Execution de la requete

$idVisiteur=4;

$userReq=$_GET['id'];

//$sql ="SELECT id FROM fichefrais WHERE idVisiteur='".$idVisiteur."' ORDER BY id DESC LIMIT 1;";

/*$sqlResultat = $cnxBDD -> query($sql);
while($userData = $sqlResultat -> fetch_assoc()) {
     $userReq = $userData['id'];
}
                
$userReq = $userReq +1;*/

$montantValide=$totalrepas+$totalnuitees/*+$totalkm+$totaletape*/;

// Insertion dans la table LigneFraisForfait de idFicheFrais, idForfait, quantite
$sql = "UPDATE fichefrais SET montantValide = '".$montantValide."' ,dateModif = '".$dte."' , mois='".$mois."' , annee='".$annee."' where id='".$userReq."';";

echo "Sql : $sql <br/>";
$result = $cnxBDD->query($sql) 
	or die ("Requete invalide : ".$sql);


$sqldelete="DELETE FROM lignefraisforfait WHERE idFicheFrais = '".$userReq."';";

$sqlrepas="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'REP', $repasmidi);";
$result=$cnxBDD->query($sqlrepas)
	or die ("Requete invalide : ".$sqlrepas);

$sqlnuit="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'NUI', $nuitees);";
$result=$cnxBDD->query($sqlnuit)
	or die ("Requete invalide : ".$sqlnuit);



/*$sqlkm="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'KM', $km);";
$result=$cnxBDD->query($sqlkm)
	or die ("Requete invalide : ".$sqlkm);

$sqletape="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'ETA', $etape);";
$result=$cnxBDD->query($sqletape)
	or die ("Requete invalide : ".$sqletape);*/


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