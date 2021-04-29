<?php 

include "mesFonctionsGenerales.php";

// connexion à la base de donnée
$cnxBDD = connexion();

$mois = $_GET['mois'];
$annee = $_GET['annee'];

$dte = date("Y-m-d");

$repasmidi = $_GET['repasmidi'];
$nuitees = $_GET['nuitees'];
$etape = $_GET['etape'];
$km=$_GET['km'];


$totalrepas=$repasmidi*getForfait('REP');
$totalnuitees=$nuitees*getForfait('NUI');
$totaletape=$etape*5;
$totalkm=$km*getForfait('K4E');

	$idVisiteur=5;
    /*$userReq ="SELECT id FROM fichefrais WHERE idVisiteur='".$idVisiteur."' ORDER BY id DESC LIMIT 1;";; 
    $userReq = $cnxBDD -> query($userReq);
    while($userData = $userReq -> fetch_assoc()) {
		$userReq=$userData['id'];
	}*/
	$sql ="SELECT id FROM fichefrais WHERE idVisiteur='".$idVisiteur."' ORDER BY id DESC LIMIT 1;";
    $sqlResultat = $cnxBDD -> query($sql);
    while($userData = $sqlResultat -> fetch_assoc()) {
        $userReq = $userData['id'];
}
                
$userReq = $userReq +1;

$montantValide=$totalrepas+$totalnuitees+$totalkm+$totaletape;

// Insertion dans la table LigneFraisForfait de idFicheFrais, idForfait, quantite
$sql = "INSERT INTO fichefrais (id,idVisiteur,mois,annee, nbJustificatifs, montantValide, dateModif, idEtat) VALUES ($userReq, $idVisiteur, $mois,$annee,0, $montantValide,'$dte',2);";

echo "Sql : $sql <br/>";
$result = $cnxBDD->query($sql) 
	or die ("Requete invalide : ".$sql);

$sqlrepas="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'REP', $repasmidi);";
$result=$cnxBDD->query($sqlrepas)
	or die ("Requete invalide : ".$sqlrepas);

$sqlnuit="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'NUI', $nuitees);";
$result=$cnxBDD->query($sqlnuit)
	or die ("Requete invalide : ".$sqlnuit);

$sqlkm="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'KM', $km);";
$result=$cnxBDD->query($sqlkm)
	or die ("Requete invalide : ".$sqlkm);

$sqletape="INSERT INTO lignefraisforfait(idFicheFrais,idForfait,quantite) VALUES ($userReq, 'ETA', $etape);";
$result=$cnxBDD->query($sqletape)
	or die ("Requete invalide : ".$sqletape);


// Fermer la connexion MYSQL
$cnxBDD->close();
		

?>