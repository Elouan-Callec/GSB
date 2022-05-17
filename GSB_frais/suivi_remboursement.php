<!-- Connexion a la base de donnees -->
<?php
include "mesFonctionsGenerales.php";
include "connexionBDD.php";
session_start();
?>

<!doctype html>
<html>

<head>
    <title>Accueil Visiteur Médical</title>
    <meta charset="utf-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Bande en haut de page -->
    <div class="HP">
        <p>Suivi de remboursement des Frais</p>
        <img src="style/gsb logo.png" class="logoHP">
    </div>

    <div class="gauche">
        <p class="titrePage">Fiche de frais de : <?php echo $_GET['nom']; ?></p>
    </div>
    <div class="milieu">
        <p class="divAjouter">
            <label class="labelAjouter">|Mois/Année: </label>
            <label class="logoAjouter">Test</label>
        </p>
        <br />
    </div>

    <div>
        <p class="titrePage" id="titrePageGestionFrais">Période</p>
        <br />
    </div>

    <?php

    $loginVisiteur = $_SESSION['login'];

    $req = $bdd->prepare("SELECT idEtat, dateModif, montantValide, quantite FROM visiteurmedical
                          INNER JOIN fichefrais
                          ON visiteurmedical.id = fichefrais.idVisiteur 
                          JOIN lignefraisforfait
                          ON fichefrais.id = lignefraisforfait.idFicheFrais
                          JOIN forfait
                          ON lignefraisforfait.idForfait = forfait.id
                          WHERE visiteurmedical.login= :login AND fichefrais.id = :id AND idForfait = 'REP'");

    $req->execute(array(
        'login' => $loginVisiteur,
        'id' => $_GET['id']
    ));

    $donnees = $req->fetch();

    $reqNuitee = $bdd->prepare("SELECT quantite FROM visiteurmedical
                          INNER JOIN fichefrais
                          ON visiteurmedical.id = fichefrais.idVisiteur 
                          JOIN lignefraisforfait
                          ON fichefrais.id = lignefraisforfait.idFicheFrais
                          JOIN forfait
                          ON lignefraisforfait.idForfait = forfait.id
                          WHERE visiteurmedical.login= :login AND fichefrais.id = :id AND idForfait = 'NUI'");

    $reqNuitee->execute(array(
        'login' => $loginVisiteur,
        'id' => $_GET['id']
    ));

    $donneesNuitee = $reqNuitee->fetch();

    $reqEtape = $bdd->prepare("SELECT quantite FROM visiteurmedical
                          INNER JOIN fichefrais
                          ON visiteurmedical.id = fichefrais.idVisiteur 
                          JOIN lignefraisforfait
                          ON fichefrais.id = lignefraisforfait.idFicheFrais
                          WHERE visiteurmedical.login= :login AND fichefrais.id = :id AND idForfait = 'ETA'");

    $reqEtape->execute(array(
        'login' => $loginVisiteur,
        'id' => $_GET['id']
    ));

    $donneesEtape = $reqEtape->fetch();

    $reqKm = $bdd->prepare("SELECT quantite FROM visiteurmedical
                          INNER JOIN fichefrais
                          ON visiteurmedical.id = fichefrais.idVisiteur 
                          JOIN lignefraisforfait
                          ON fichefrais.id = lignefraisforfait.idFicheFrais
                          JOIN forfait
                          ON lignefraisforfait.idForfait = forfait.id
                          WHERE visiteurmedical.login= :login AND fichefrais.id = :id AND idForfait = 'KM'");

    $reqKm->execute(array(
        'login' => $loginVisiteur,
        'id' => $_GET['id']
    ));

    $donneesKm = $reqKm->fetch();

    //while ($req = $req->fetch()) {
    ?>

    <div class="titre2">
        Frais au forfait
    </div>

    <table class="bordure">
        <tr>
            <td>Repas midi</td>
            <td>Nuitée</td>
            <td>Etape</td>
            <td>Km</td>
            <td>Situation</td>
            <td>Date opération</td>
            <td>Remboursement</td>
        </tr>
        <tr>
            <td><?php echo $donnees['quantite']; ?></td>
            <td><?php echo $donneesNuitee['quantite']; ?></td>
            <td><?php echo $donneesEtape['quantite']; ?></td>
            <td><?php echo $donneesKm['quantite']; ?></td>
            <td><?php echo $donnees['idEtat']; ?></td>
            <td><?php echo $donnees['dateModif']; ?></td>
            <td><?php echo $donnees['montantValide']; ?></td>
        </tr>
    </table>

    <?php
    //}
    ?>

</body>

</html>