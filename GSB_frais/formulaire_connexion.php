<!-- Connexion a la base de donnees -->
<?php
include "connexionBDD.php";
session_start();
?>

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
        <img src="style/gsb logo.png" class="logoHP">
    </div>


    <?php

    // Récupération du login et password du formulaire
    if (isset($_POST['login'])) {
        $login = $_POST['login'];
        $_SESSION['login'] = $_POST['login'];
    }
    if (isset($_POST['password'])) {
        $password = $_POST['password'];
        $_SESSION['password'] = $_POST['password'];
    }

    // Requête pour rechercher le login et password du visiteur
    if (isset($login) and isset($password)) {
        $req = $bdd->prepare('SELECT login, mdp, prenom FROM visiteurmedical WHERE login = :login AND mdp = :password');
        $req->execute(array(
            'login' => $login,
            'password' => $password
        ));
        $donnees = $req->fetch();
    }

    // Verification du login et du mot de passe
    if (isset($donnees)) :
        if ($login === $donnees['login'] and $password === $donnees['mdp']) {
            header('Location:interface.php');
        } else echo '<h2>Mauvais identifiant ou mot de passe !</h2>';
    endif;

    ?>


    <form method="POST" action="formulaire_connexion.php" class="smallForm">
        <p class="titreFormulaire">Connexion</p>
        <div class="centre">
            <p>
                <label>Identifiant : </label>
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