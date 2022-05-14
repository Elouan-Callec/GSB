<!doctype html>
<html>

<head>
    <title>Connexion</title>
    <meta charset="utf-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <!-- Bande en haut de page -->
    <div class="HP">
        <p>Identification</p>
        <img src="style/gsb logo.png" class="logo">
    </div>

    <form method="POST" action="formulaire_connexion.html" class="smallForm">
        <p class="titreFormulaire">Connexion</p>
        <div class="centre">
            <p>
                <label>Login : </label>
                <input name="login" id="login" value="" type="text" class="case" />
            </p>
        </div>
        <br>
        <div class="centre">
            <p>
                <label>Mot de passe : </label>
                <input name="password" id="password" value="" type="password" class="case" />
            </p>
        </div>
        <br />
        <div class="centre">
            <input type="reset" class="bouton" value="Effacer" />
            <input type="submit" class="bouton" value="Valider" />
        </div>
    </form>
</body>

</html>