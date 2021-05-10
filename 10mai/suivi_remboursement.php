<!doctype html>

<head>
    <title>
        Suivi de remboursement des Frais
    </title>
    <meta charset="utf-8" />
    <link type="text/css" rel="stylesheet" href="style.css" />
</head>

<body>

    <?php

    include "mesFonctionsGenerales.php";
    
    $userReq = "SELECT idEtat, dateModif, montantValide, quantite 
                FROM visiteurmedical
                INNER JOIN fichefrais
                ON visiteurmedical.id = fichefrais.idVisiteur 
                JOIN lignefraisforfait
                ON fichefrais.id = lignefraisforfait.idFicheFrais
                JOIN forfait
                ON lignefraisforfait.idForfait = forfait.id
                WHERE visiteurmedical.id="2""

    $userReq = $cnxBDD -> query($userReq);

    while($userData = $userReq -> fetch_assoc()) {

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
            <td>Pas fini</td>
            <td>3</td>
            <td>0</td>
            <td>250</td>
            <td><?php echo $userData ['idEtat']; ?></td>
            <td>3/12/2010</td>
            <td>654.55€</td>
        </tr>
    </table>

    <?php
    }
    ?> 

</body>