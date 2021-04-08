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
	if ( isset($_GET['BOmodif'] ) )
	{
		$monTraitement = "updateContact.php";		/* Traitement SQL à appeler après la FORM */
		$monAction = "Modif";

		/* Chercher dans la base les valeurs à modifier */
		$cnxBDD = connexion();

        $sql = "SELECT id, nom, prenom, eMail, telMobile, dteNaissance, adresse
				 FROM Contact
				 WHERE id = ".$_GET['BOmodif'].";";

        $result = $cnxBDD->query($sql);
		$maLigne = $result->fetch_assoc();

		$numContact = $maLigne['id'];
		$nom = $maLigne['nom'];
		$prenom= $maLigne['prenom'];
		$eMail= $maLigne['eMail'];
		$telMobile= $maLigne['telMobile'];
		$dteNaissance= $maLigne['dteNaissance'];
		$adresse = $maLigne['adresse'];
	}
	else
	{
		/* Cas d'une insertion */
		$monTraitement = "insertContact.php";	/* Traitement SQL à appeler après la FORM */
		$monAction = "Insert";

		$numContact = '';
		$nom = '';
		$prenom= '';
		$eMail= '';
		$telMobile= '';
		$dteNaissance= '';
		$adresse = '';
	}
	?>
	<div class="container">

		<p class="bandeau">
			Création de Contact
		</p>

		<form id="formulaire" action="<?php echo $monTraitement; ?>" method="GET">
		<div class="bloc1">
			<label><b><u>Identification du contact :</u></b></label>

			<input type="hidden" id="id" name="id"  value= "<?php echo $numContact; ?>" />
			<br/>
			<br/>

			<label>Nom :</label>
			<input type="text" id="nom" name="nom" required value= "<?php echo $nom; ?>" />

			<br/>
			<br/>

			<label>Prenom :</label>
			<input type="text" id="prenom" name="prenom" value= "<?php echo $prenom; ?>" required/>

			<br/>
			<br/>

			<label>Adresse :</label>
			<input type="text" id="adresse" name="adresse" value= "<?php echo $adresse; ?>" placeholder="15 avenue champ de foire, 0100 Bourg en Bresse" style="width: 295px;" required/>

			<br/>
			<br/>

			<label>Date de naissance :</label>
			<select name="jourNaissance" id="jourNaissance" value= "<?php echo substr($dteNaissance,8,2); ?>" style="width: 50px;" required>
				<option>Jour</option>
				<?php
					for($i=1;$i<32;$i++){
						if($i < 10){
							echo "<option>0".$i."</option>";
						} else {
							echo "<option>".$i."</option>";
						}
					}
				?>
			</select>
			<select name="moisNaissance" id="moisNaissance" style="width: 50px;" value="<?php echo substr($dteNaissance,5,2); ?>" required>
				<option>Mois</option>
				<?php
					for($i=1;$i<13;$i++){
						if($i < 10){
							echo "<option>0".$i."</option>";
						} else {
							echo "<option>".$i."</option>";
						}
					}
				?>
			</select>
			<select name="anneeNaissance" id="anneeNaissance" style="width: 65px;" value= "<?php echo substr($dteNaissance,0,4); ?>" required>
				<option>Année</option>:
				<?php
					for($i=2020;$i>1920;$i--){
						echo "<option>".$i."</option>";
					}
				?>
			</select>
			<br/>
			<br/>

			<label>Email :</label>
			<input type="text" id="eMail" name="eMail" value= "<?php echo $eMail; ?>"/>

			<br/>
			<br/>

			<label>Téléphone mobile :</label>
			<input type="text" id="telMobile" name="telMobile" value= "<?php echo $telMobile; ?>"/>

			<br/>

			<button class="bouton" name=<?php echo $monAction; ?> type="submit" value="Modifier" title=""><img src="./CSS/images/Valider.png"/> Valider</button>	

			<a href="index.php">
				<button class="bouton2"name="retour"type="button" value="Retour" title=""><img src="./CSS/images/Annuler.png"/> Retour</button>
			</a>
		</div>
		
		</form>
	</div>
</body>
</html>