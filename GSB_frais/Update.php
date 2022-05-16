<?php
include "connexionBDD.php";
include "mesFonctionsGenerales.php";
session_start();

// Declaration des variables
$idVisiteur = $_SESSION['idVisiteur'];
$mois = $_POST['mois'];
$annee = $_POST['annee'];
$dateJour = date('Y-m-d');
$repasmidi = $_POST['repasmidi'];
$nuitees = $_POST['nuitees'];
$etape = $_POST['etape'];
$km = $_POST['km'];
$idFicheFrais = $_POST['idFicheFrais'];

// Calcul des totaux
$nbJustificatifs = $repasmidi + $nuitees + $etape;
$totalrepas = $repasmidi * getForfait('REP');
$totalnuitees = $nuitees * getForfait('NUI');
$totaletape = $etape * 5;
$totalkm = $km * getForfait('K4E');
$montantValide = $totalrepas + $totalnuitees + $totaletape + $totalkm;

// Requete de modification dans fichefrais
$req = $bdd->prepare("UPDATE fichefrais 
					  SET mois = :mois, annee = :annee, nbJustificatifs = :nbJustificatifs, montantValide = :montantValide, dateModif = :dateJour
					  WHERE id= :idFicheFrais");

$req->bindParam('mois', $mois);
$req->bindParam('annee', $annee);
$req->bindParam('nbJustificatifs', $nbJustificatifs);
$req->bindParam('montantValide', $montantValide);
$req->bindParam('dateJour', $dateJour);
$req->bindParam('idFicheFrais', $idFicheFrais);

$req->execute()
	or die("Requete invalide");

// Requete de suppression
$req = $bdd->prepare("DELETE FROM lignefraisforfait 
					  WHERE idFicheFrais = :idFicheFrais");

$req->bindParam('idFicheFrais', $idFicheFrais);

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
