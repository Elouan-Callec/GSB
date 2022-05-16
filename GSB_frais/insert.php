<?php
include "connexionBDD.php";
include "mesFonctionsGenerales.php";
session_start();

// Declaration des variables
$idVisiteur = $_SESSION['idVisiteur'];
$mois = $_POST['mois'];
$annee = $_POST['annee'];
$repasmidi = $_POST['repasmidi'];
$nuitees = $_POST['nuitees'];
$etape = $_POST['etape'];
$km = $_POST['km'];

// Calcul des totaux
$nbJustificatifs = $repasmidi + $nuitees + $etape;
$totalrepas = $repasmidi * getForfait('REP');
$totalnuitees = $nuitees * getForfait('NUI');
$totaletape = $etape * 5;
$totalkm = $km * getForfait('K4E');
$montantValide = $totalrepas + $totalnuitees + $totaletape + $totalkm;

// Recuperation de l'id de la derniere fiche de l'utilisateur pour connaitre l'id de la fiche qui va etre cree
$req = $bdd->prepare("SELECT id FROM fichefrais 
					 WHERE idVisiteur= :idVisiteur 
					 ORDER BY id 
					 DESC LIMIT 1;");

$req->execute(array(
	'idVisiteur' => $idVisiteur
));

while ($userData = $req->fetch()) {
	$idFicheFrais = $userData['id'];
}

$idFicheFrais = $idFicheFrais + 1;

// Preparation de la requete d'insertion dans fichefrais
$req = $bdd->prepare("INSERT INTO fichefrais (idVisiteur, mois, annee, nbJustificatifs, montantValide, idEtat) 
					  VALUES (:idVisiteur, :mois, :annee, :nbJustificatifs, :montantValide, 'CR');");

$req->bindParam('idVisiteur', $idVisiteur);
$req->bindParam('mois', $mois);
$req->bindParam('annee', $annee);
$req->bindParam('nbJustificatifs', $nbJustificatifs);
$req->bindParam('montantValide', $montantValide);

// Execution de la requete
$req->execute()
	or die("Requete invalide");

// Preparation et execution des requetes d'insertion dans lignefraisforfait
// Repas
$reqrepas = $bdd->prepare("INSERT INTO lignefraisforfait (idFicheFrais, idForfait, quantite) 
						   VALUES (:idFicheFrais, 'REP', :repasmidi);");

$reqrepas->bindParam('idFicheFrais', $idFicheFrais);
$reqrepas->bindParam('repasmidi', $repasmidi);

$reqrepas->execute()
	or die("Requete invalide");

// Nuitees
$reqnuit = $bdd->prepare("INSERT INTO lignefraisforfait (idFicheFrais, idForfait, quantite) 
						  VALUES (:idFicheFrais, 'NUI', :nuitees);");

$reqnuit->bindParam('idFicheFrais', $idFicheFrais);
$reqnuit->bindParam('nuitees', $nuitees);

$reqnuit->execute()
	or die("Requete invalide");

// Kilometres
$reqkm = $bdd->prepare("INSERT INTO lignefraisforfait (idFicheFrais, idForfait, quantite) 
						VALUES (:idFicheFrais, 'KM', :km);");

$reqkm->bindParam('idFicheFrais', $idFicheFrais);
$reqkm->bindParam('km', $km);

$reqkm->execute()
	or die("Requete invalide");

// Etapes
$reqetape = $bdd->prepare("INSERT INTO lignefraisforfait (idFicheFrais, idForfait, quantite) 
						   VALUES (:idFicheFrais, 'ETA', :etape);");

$reqetape->bindParam('idFicheFrais', $idFicheFrais);
$reqetape->bindParam('etape', $etape);

$reqetape->execute()
	or die("Requete invalide");

// Redirection en fonction du résultat de la requête
if ($req & $reqrepas & $reqnuit & $reqkm & $reqetape) {
	header('Location:interface.php');
} else {
	echo "Un problème est survenu";
}
