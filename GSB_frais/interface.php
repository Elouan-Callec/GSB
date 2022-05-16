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
    $req = $bdd->query('SELECT id, nom FROM visiteurmedical 
                        WHERE visiteurmedical.login = ' . $_SESSION['login']);
    $userData = $req->fetch();
    $_SESSION['idVisiteur'] = $userData['id'];
    ?>

    <div class="gauche">
        <p class="titrePage">Fiche de frais de : <?php echo $userData['nom']; ?></p>
    </div>
    <div class="milieu">
        <p class="divAjouter">
            <label class="labelAjouter">Ajouter</label>
            <a href="ajoutFicheFrais.php"><img src="style/bouton/add.png" class="logoAjouter"></a>
        </p>
    </div>


    <div class="tableau">
        <table>
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
                $req = $bdd->prepare('SELECT nom, prenom, mois, annee, montantValide, idEtat, fichefrais.id FROM visiteurmedical 
                        INNER JOIN fichefrais 
                        ON visiteurmedical.id = fichefrais.idVisiteur
                        WHERE visiteurmedical.login = ? 
                        ORDER BY annee');

                $req->execute(array(htmlspecialchars($_SESSION['login'])));

                while ($donnees = $req->fetch()) {
                ?>

                    <tr>
                        <td><?php echo $donnees['id']; ?></td>
                        <td><?php echo $donnees['nom']; ?></td>
                        <td><?php echo $donnees['prenom']; ?></td>
                        <td><?php echo $donnees['mois']; ?></td>
                        <td><?php echo $donnees['annee']; ?></td>
                        <td><?php echo $donnees['montantValide']; ?></td>
                        <td><?php echo $donnees['idEtat']; ?></td>
                        <td><a href="Delete.php"><img src="style/bouton/corbeille.png" class='logo'></a></td>
                        <td><a href="modifFicheFrais.php?id=<?php echo $donnees['id']; ?>"><img src="style/bouton/modify.png" class='logo'></a></td>
                        <td><a href="suivi_remboursement.php"><img src="style/bouton/voir.png" class='logo'></a></td>
                    </tr>

                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
</body>

</html>