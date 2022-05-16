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

    <?php

    $loginVisiteur = $_SESSION['login'];

    $req = $bdd->prepare("SELECT idForfait, idEtat, dateModif, montantValide, quantite FROM visiteurmedical
                          INNER JOIN fichefrais
                          ON visiteurmedical.id = fichefrais.idVisiteur 
                          JOIN lignefraisforfait
                          ON fichefrais.id = lignefraisforfait.idFicheFrais
                          JOIN forfait
                          ON lignefraisforfait.idForfait = forfait.id
                          WHERE visiteurmedical.login= :login AND fichefrais.id = :id");

    $req->execute(array(
        'login' => $loginVisiteur,
        'id' => $_GET['id']
    ));

    while ($userData = $req->fetch()) {
    ?>

        <div class="titre">
            Fiche de frais de :
        </div>

        <div>
            <topGauche>Période</topGauche>
            <topDroite>|Mois/Année: </topDroite>
        </div>

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
                <td><?php echo $userData['idForfait']; ?></td>
                <td><?php echo $userData['idForfait']; ?></td>
                <td><?php echo $userData['idForfait']; ?></td>
                <td><?php echo $userData['idForfait']; ?></td>
                <td><?php echo $userData['idEtat']; ?></td>
                <td><?php echo $userData['dateModif']; ?></td>
                <td><?php echo $userData['montantValide']; ?></td>
            </tr>
        </table>

    <?php
    }
    ?>

</body>

</html>