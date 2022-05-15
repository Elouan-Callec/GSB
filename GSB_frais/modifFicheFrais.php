<!-- Connexion a la base de donnees -->
<?php
include "connexionBDD.php";
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion de frais</title>
    <meta charset="utf-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

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

    $nuitees=0;
    $repasmidi=0;
    
    $result = $cnxBDD->query($sql);
    $maLigne = $result->fetch_assoc();
    $identifiant = $maLigne['id'];
    $idVisiteur = $maLigne['idVisiteur'];
    $mois= $maLigne['mois'];
    $annee= $maLigne['annee'];
    $montantValide=$maLigne['montantValide'];
    $nbJustificatifs= $maLigne['nbJustificatifs'];
    $dateModif = $maLigne['dateModif'];
    $idEtat = $maLigne['idEtat'];

    $get_data="SELECT idForfait, quantite 
                FROM lignefraisforfait 
                WHERE idFicheFrais=".$_GET['id'].";";
    $get_data=$cnxBDD -> query($get_data);
    
    while ($elements=$get_data -> fetch_assoc()){     
        switch ($elements['idForfait']){
            case 'NUI':
                $nuitees=$elements['quantite'];
                break;
            case 'REP':
                $repasmidi=$elements['quantite'];
                break;
            /*case 'ETA' :
                $etape=$elements['quantite'];
                break;
            case 'KM' : 
                $km=$elements['quantite'];
                break;*/
        }
    }
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
    /*$etape='';
    $km = '';*/
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
                
                
                <input type="hidden" id="id" name="id" value= "<?php echo $_GET['id']; ?>"/>
                

                <div>
                    <label for="repasmidi">Repas midi : </label>
                    <input type="text" id="repasmidi" name="repasmidi" value= "<?php echo $repasmidi; ?>"/>
                    
                </div>
                <br>
                <div>
                    <label for="nuitees">Nuitées : </label>
                    <input type="text" id="nuitees" name="nuitees" value= "<?php echo $nuitees; ?>"/>
                </div>
                <br>
                <!--<div>
                    <label for="etape">Etape : </label>
                    <input type="text" id="etape" name="etape" value= "<?php echo $etape; ?>"/>
                </div>
                <br>
                <div>
                    <label for="km">Km : </label>
                    <input type="text" id="km" name="km" value= "<?php echo $km; ?>"/>
                </div>-->
                <br/>
                
                <div>
                    <input type="submit">
                </div>
            </form>
    </div>
</body>
</html>