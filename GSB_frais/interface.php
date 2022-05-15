<!-- Connexion a la base de donnees -->
<?php
include "connexionBDD.php";
session_start();
?>

<!doctype html>
<html>

<head>
    <title>Accueil Visiteur Médical</title>
    <meta charset="utf-8" />
    <link href="style/style.css" rel="stylesheet" type="text/css">
</head>

<body id="accueil">

    <!-- Bande en haut de page -->
    <div class="HP">
        <p>Accueil</p>
        <img src="style/gsb logo.png" class="logoHP">
    </div>


    <?php
    $req = $bdd->query('SELECT nom FROM visiteurmedical 
                        WHERE visiteurmedical.login = ' . $_SESSION['login']);
    $userData = $req->fetch();
    ?>


    <div>
        <p class="titrePage">Fiche de frais de : <?php echo $userData['nom']; ?></p>

        <div class="logoAjouter">
            <p>
                <label>Ajouter</label>
                <a href="fiche_frais.php"><img src="style/bouton/add.png"></a>
            </p>
        </div>

        <div class="tableau">
            <table class="t1 t2" width="100%">
                <thead>
                    <tr>
                        <th>Identifiant</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Mois</th>
                        <th>Année</th>
                        <th>Montant total</th>
                        <th>Etat</th>
                        <th>Supprimer</th>
                        <th>Modifier</th>
                        <th>Voir</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $req = $bdd->prepare('SELECT * FROM visiteurmedical 
                        INNER JOIN fichefrais 
                        ON visiteurmedical.id = fichefrais.idVisiteur
                        WHERE visiteurmedical.login = ? 
                        ORDER BY annee');

                    $req->execute(array(htmlspecialchars($_SESSION['login'])));

                    while ($donnes = $req->fetch()) {
                    ?>

                        <tr>
                            <td><?php echo $donnes['idVisiteur']; ?></td>
                            <td><?php echo $donnes['nom']; ?></td>
                            <td><?php echo $donnes['prenom']; ?></td>
                            <td><?php echo $donnes['mois']; ?></td>
                            <td><?php echo $donnes['annee']; ?></td>
                            <td><?php echo $donnes['montantValide']; ?></td>
                            <td><?php echo $donnes['idEtat']; ?></td>
                            <td><a href="Delete.php"><img src="style/bouton/corbeille.png" class='logo'></a></td>
                            <td><a href="fiche_frais.php"><img src="style/bouton/modify.png" class='logo'></a></td>
                            <td><a href="suivi_remboursement.php"><img src="style/bouton/voir.png" class='logo'></a></td>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>
</body>

</html>