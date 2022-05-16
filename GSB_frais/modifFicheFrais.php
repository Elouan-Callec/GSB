<!-- Connexion a la base de donnees -->
<?php
include "connexionBDD.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des frais</title>
    <meta charset="utf-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php

    // Recuperation des valeurs de fichefrais
    $req = $bdd->prepare("SELECT id, idVisiteur, mois, annee, nbJustificatifs, montantValide, dateModif, idEtat FROM fichefrais
                          WHERE id = :id");

    $req->execute(array('id' => $_GET['id']));
    $donnees = $req->fetch();

    // Declaration des variables
    $identifiantFicheFrais = $donnees['id'];
    $idVisiteur = $donnees['idVisiteur'];
    $mois = $donnees['mois'];
    $annee = $donnees['annee'];
    $nbJustificatifs = $donnees['nbJustificatifs'];
    $montantValide = $donnees['montantValide'];
    $dateModif = $donnees['dateModif'];
    $idEtat = $donnees['idEtat'];

    // Recuperation des valeurs de lignefraisforfait
    $req = $bdd->prepare("SELECT idForfait, quantite FROM lignefraisforfait 
                          WHERE idFicheFrais= :id");

    $req->execute(array('id' => $_GET['id']));


    while ($elements = $donnees = $req->fetch()) {
        switch ($elements['idForfait']) {
            case 'NUI':
                $nuitees = $elements['quantite'];
                break;
            case 'REP':
                $repasmidi = $elements['quantite'];
                break;
            case 'ETA':
                $etape = $elements['quantite'];
                break;
            case 'KM':
                $km = $elements['quantite'];
                break;
        }
    }
    ?>

    <!-- Bande en haut de page -->
    <div class="HP">
        <p>Gestion des Frais</p>
        <img src="style/gsb logo.png" class="logoHP">
    </div>

    <div>
        <p class="titrePage" id="titrePageGestionFrais">Saisie</p>
        <br />
    </div>

    <form method="POST" id="formulaire" action="update.php">
        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="idFicheFrais">
        <section>
            <div class="gauche" id="gaucheGestionFrais">
                <p>PERIODE D'ENGAGEMENT :</p>
            </div>
            <div class="milieu" id="milieuGestionFrais">
                <label for="mois">Mois (2 chiffres) : </label>
                <input type="text" id="mois" name="mois" value="<?php echo $mois; ?>" />

                <label for="annee">Années (4 chiffres) : </label>
                <input type="text" id="annee" name="annee" value="<?php echo $annee; ?>" />
            </div>
        </section>

        <br />

        <section>
            <h1>Frais au forfait</h1>

            <div>
                <label for="repasmidi">Repas midi :</label>
                <input type="text" id="repasmidi" name="repasmidi" value="<?php echo $repasmidi; ?>" />
            </div>
            <div>
                <label for="nuitees">Nuitées :</label>
                <input type="text" id="nuitees" name="nuitees" value="<?php echo $nuitees; ?>" />
            </div>
            <div>
                <label for="etape">Etape :</label>
                <input type="text" id="etape" name="etape" value="<?php echo $etape; ?>" />
            </div>
            <div>
                <label for="km">Km :</label>
                <input type="text" id="km" name="km" value="<?php echo $km; ?>" />
            </div>
            <br />
        </section>

        <div>
            <input type="submit" value="Soumettre la requête" class="bouton">
        </div>
    </form>
    </div>
</body>

</html>