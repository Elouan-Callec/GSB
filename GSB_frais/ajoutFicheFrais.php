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
    setlocale(LC_TIME, 'fr_FR');
    date_default_timezone_set('Europe/Paris');
    $mois = utf8_encode(strftime('%m'));
    $annee = utf8_encode(strftime('%Y'));
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

    <form method="POST" id="formulaire" action="insert.php">
        <section>
            <div class="gauche" id="gaucheGestionFrais">
                <p>PERIODE D'ENGAGEMENT :</p>
            </div>
            <div class="milieu" id="milieuGestionFrais">
                <label for="mois">Mois (2 chiffres) : </label>
                <input type="text" id="mois" name="mois" value="<?php echo $mois; ?>" disabled="disabled" />

                <label for="annee">Années (4 chiffres) : </label>
                <input type="text" id="annee" name="annee" value="<?php echo $annee; ?>" disabled="disabled" />
            </div>
        </section>

        <br />

        <section>
            <h1>Frais au forfait</h1>

            <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />


            <div>
                <label for="repasmidi">Repas midi : </label>
                <input type="text" id="repasmidi" name="repasmidi"/>

            </div>
            <div>
                <label for="nuitees">Nuitées : </label>
                <input type="text" id="nuitees" name="nuitees"/>
            </div>
            <div>
                <label for="etape">Etape : </label>
                <input type="text" id="etape" name="etape"/>
            </div>
            <div>
                <label for="km">Km : </label>
                <input type="text" id="km" name="km"/>
            </div>
            <br />
        </section>

        <div>
            <input type="submit" value="Soumettre la requête">
        </div>
    </form>
    </div>
</body>

</html>