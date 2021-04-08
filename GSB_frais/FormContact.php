<!DOCTYPE html>
<html>
<head>
<head>
	<title>Création de Contact</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./CSS/Table-CSS/main.css">
	<link rel="stylesheet" type="text/css" href="./CSS/style.css">
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

        $sql = "SELECT id, nom, prenom, adresse, ville, cp, dateEmbauche
				 FROM visiteurmedical
				 WHERE id = ".$_GET['id'].";";

        $result = $cnxBDD->query($sql);
		$maLigne = $result->fetch_assoc();
		$identifiant = $maLigne['id']; //'id' provient de Identifiant en dessous
		$nom = $maLigne['nom'];
		$prenom= $maLigne['prenom'];
		$adresse= $maLigne['adresse'];
		$ville= $maLigne['ville'];
        $dateEmbauche = $maLigne['dateEmbauche'];
		$cp = $maLigne['cp'];
    }
    else
    {
        /* Cas d'une insertion */
		$monTraitement = "insert.php";	/* Traitement SQL à appeler après la FORM */
        $monAction = "Insert";
        
        $identifiant = '';
        $nom = '';
        $prenom = '';
        $adresse = '';
        $ville = '';
        $dateEmbauche = '';
        $cp = '';
        
    }
	?>
	        
    <div class="fond">
    
        <p><h1>Visiteur</h1></p>

        <fieldset class="cadre">
            <form id="formulaire" action="<?php echo $monTraitement; ?>" method="GET">
                <div>
                    <label for="id">Identifiant : </label>
                    <input type="text" id="id" name="id" value= "<?php echo $identifiant; ?>"/>
                </div>
                <br>
                <div>
                    <label for="nom">Nom : </label>
                    <input type="text" id="nom" name="nom" required value= "<?php echo $nom; ?>"/>
                </div>
                <br>
                <div>
                    <label for="prenom">Prénom : </label>
                    <input type="text" id="prenom" name="prenom" value= "<?php echo $prenom; ?>" required/>
                </div>
                <br>
                <div>
                    <label for="adresse">Adresse : </label>
                    <input type="text" id="adresse" name="adresse" value= "<?php echo $adresse; ?>"/>
                </div>
                <br>
                <div>
                    <label for="ville">Ville : </label>
                    <input type="text" id="ville" name="ville" value= "<?php echo $ville; ?>"/>
                </div>
                <br>
                <div>
                    <label for="cp">CP : </label>
                    <input type="text" id="cp" name="cp" value= "<?php echo $cp; ?>"/>
                </div>
                <br>
                <div>
                    <label for="dateEmbauche">Date d'embauche : </label>
                    <input type="text" id="dateEmbauche" name="dateEmbauche" value= "<?php echo $dateEmbauche; ?>"/>
                </div>
                <br>
                <div>
                    <label for="login">Login : </label>
                    <input type="text" id="login" name="login"/>
                </div>
                <br>
                <div>
                    <label for="mdp">Mot de passe :</label>
                    <input type="password" id="mdp" name="mdp"/>
                </div>
                <br>
                
                <div>
                    <input type="submit">
                </div>
            </form>
        </fieldset>
</body>
</html>