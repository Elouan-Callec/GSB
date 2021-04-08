<DOCTYPE html>
    <html>
        <head>
            <title>Visiteur</title>
            <meta charset="utf-8"/>
            <link type="text/css" rel="stylesheet" href="css.css" />
        </head>

<body>
	<?php

	include "mesFonctionsGenerales.php";

	/* On regarde si on est dans le cas d'une modification */
	if ( isset($_GET['BOmodif'] ) )
	{
		$monTraitement = "updateContact.php";		/* Traitement SQL à appeler après la FORM */
		$monAction = "Modif";

		/* Chercher dans la base les valeurs à modifier */
		$cnxBDD = connexion();

        $sql = "SELECT id, nom, prenom, adresse, ville, dateEmbauche, cp
				 FROM visiteurmedical
				 WHERE id = ".$_GET['BOmodif'].";";

        $result = $cnxBDD->query($sql);
		$maLigne = $result->fetch_assoc();

		$id = $maLigne['id']; //Id du value de interface.html et 'id' provient de Identifiant en dessous
		$nom = $maLigne['nom'];
		$prenom= $maLigne['prenom'];
		$adresse= $maLigne['adresse'];
		$ville= $maLigne['ville'];
		$dteNaissance= $maLigne['dateEmbauche'];
		$cp = $maLigne['cp'];
	}
	?>
	<div class="fond">
            <p><h1>Visiteur</h1></p>

        <fieldset class="cadre">
            <form action="FormContact.php" method="get">
                <div>
                    <label for="id">Identifiant : </label>
                    <input type="text" id="id" name="identifiant"/>
                    <input type="hidden" id="id" name="id"  value= "<?php echo $id; ?>" />
                </div>
                <br>
                <div>
                    <label for="nom">Nom : </label>
                    <input type="text" id="nom" name="nom"/>
                </div>
                <br>
                <div>
                    <label for="prenom">Prénom : </label>
                    <input type="text" id="prenom" name="prenom"/>
                </div>
                <br>
                <div>
                    <label for="adresse">Adresse : </label>
                    <input type="text" id="adresse" name="adresse"/>
                </div>
                <br>
                <div>
                    <label for="ville">Ville : </label>
                    <input type="text" id="ville" name="ville"/>
                </div>
                <br>
                <div>
                    <label for="cp">CP : </label>
                    <input type="text" id="cp" name="cp"/>
                </div>
                <br>
                <div>
                    <label for="dateembauche">Date d'embauche : </label>
                    <input type="text" id="dateembauche" name="dateembauche"/>
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
</body>
</html>