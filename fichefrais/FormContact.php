<!DOCTYPE html>
<html>
<head>
<head>
	<title>Gestion de frais</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="default.css">
</head>

<body>
<?php

include "mesFonctionsGenerales.php";

/* On regarde si on est dans le cas d'une modification */
if ( isset($_GET['BOmodif'] ) ==true)
{
    $monTraitement = "Update.php";		/* Traitement SQL à appeler après la FORM */
    $monAction = "Modif";

    /* Chercher dans la base les valeurs à modifier */
    $cnxBDD = connexion();

    $sql = "SELECT id, idVisiteur, mois, annee, nbJustificatifs, montantValide  , dateModif,idEtat
             FROM fichefrais
             WHERE id = ".$_GET['id'].";";

    $result = $cnxBDD->query($sql);
    $maLigne = $result->fetch_assoc();
    $identifiant = $maLigne['id']; //'id' provient de Identifiant en dessous
    $idVisiteur = $maLigne['idVisiteur'];
    $mois= $maLigne['mois'];
    $annee= $maLigne['annee'];
    $montantValide=$maLigne['montantValide'];
    $nbJustificatifs= $maLigne['nbJustificatifs'];
    $dateModif = $maLigne['dateModif'];
    $idEtat = $maLigne['idEtat'];

}
else
{
    /* Cas d'une insertion */
    $monTraitement = "insert.php";	/* Traitement SQL à appeler après la FORM */
    $monAction = "Insert";
    
    $identifiant = '';
    $idVisiteur = '';
    $mois = '';
    $annee = '';

    $montantValide = '';
    $repasmidi = '';
    $nuitees = '';
    $etape='';
    $km = '';
    
}
?>
	        
    <div class="couleurecriture">
    
        <p ><h1>Saisie</h1></p>

            <form id="formulaire" action="<?php echo $monTraitement; ?>" method="GET">
                <h2>PERIODE D'ENGAGEMENT : </h2>
                
                <label for="mois">Mois (2 chiffres) : </label>
                <input type="text" id="mois" name="mois" value= "<?php echo $mois; ?>"/>

                <label for="annee">Années (4 chiffres) : </label>
                <input type="text" id="annee" name="annee" value= "<?php echo $annee; ?>"/>            
                
                
                
                <p><h3>Frais au forfait : </h3></p>
                
                <div>
                    <label for="repasmidi">Repas midi : </label>
                    <input type="text" id="repasmidi" name="repasmidi" value= "<?php echo $repasmidi; ?>"/>
                    
                </div>
                <?php echo $repasmidi; ?>
                <br>
                <div>
                    <label for="nuitees">Nuitées : </label>
                    <input type="text" id="nuitees" name="nuitees" value= "<?php echo $nuitees; ?>"/>
                </div>
                <br>
                <div>
                    <label for="etape">Etape : </label>
                    <input type="text" id="etape" name="etape" value= "<?php echo $etape; ?>"/>
                </div>
                <br>
                <div>
                    <label for="km">Km : </label>
                    <input type="text" id="km" name="km" value= "<?php echo $km; ?>"/>
                </div>
                <br/>
                
                <div>
                    <input type="submit">
                </div>
            </form>
    </div>
</body>
</html>