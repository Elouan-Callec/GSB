<!DOCTYPE html>
<html>
<head>
    <title>Liste des Contacts</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="./CSS/Table-CSS/main.css">
</head>

<body>


<?php
    /* Préparer les données */

    include "mesFonctionsGenerales.php";
    $cnxBDD = connexion();

    $sql = "SELECT id, nom, prenom FROM visiteurmedical;";
    $lignes = $cnxBDD->query($sql) or die (afficheErreur($sql, $cnxBDD->error_list[0]['error']));
    /* $lignes = array();
    
    $lignes = $result->fetch_array();*/
?>

<!-- Entete du tableau -->
<div class="container">

<p class="bandeau">
    Liste des Contacts
</p>
<table class="table-fill">
    <!-- Header du Tableau -->
    <thead>
        <tr>
            <th class="text-center">Numéro</th>
            <th class="text-center">Nom</th>
            <th class="text-center">Prénom</th>
            <th class="text-center">Supprimer</th>
            <th class="text-center">Modifier</th>
        </tr>
    </thead>
    <!--Body du Tableau -->
    <tbody class="table-hover">

    <?php
 
        /* echo '<br> Vous avez '.sizeof($lignes).' contacts. </br>'; */

        foreach ( $lignes as $maLigne )
        {

            /* Initialisation des variables pour afficher le tableau */
            /* $numContact = $rows['no']; */
            $numContact = $maLigne['id'];
            $nom = $maLigne['nom'];
            $prenom= $maLigne['prenom'];


           //Affichage de la ligne dans le tableau

    
                        echo "<tr>";
                        echo "<td class=\"numContact\" style=\"text-align: center; width: 15px;\">$numContact</td>";
                        echo "<td class=\"nom\" style=\"text-align: center; width: 20px;\">$nom</td>";
                        echo "<td class=\"prenom\" style=\"text-align: center; width: 20px;\">$prenom</td>";
                        echo "<td class=\"supprimer\" style=\"text-align: center; width: 30px;\">
                                <form action='Delete.php' method='get'>
                                    <button type='submit' onclick=\"if(!confirm('Voulez-vous supprimer ce contact ?')) return false;\">
                                        <img src='./CSS/images/Delete.png'/>
                                    </button>
                                    <input id='delete' name='BOdelete' type='hidden' value='$numContact'/>
                                </form>
                                </td>";
                        // Création du bouton pour éditer l'entrée de la bdd
                        echo "<td class=\"edit\" style=\"text-align: center; width: 30px;\">
                                <form action='FormContact.php' method='get'>
                                    <button type='submit'>
                                        <img src='./CSS/images/Edit.png'/>
                                    </button>
                                    <input id='editContact' name='BOmodif' type='hidden' value='$numContact'/>
                                </form>
                                </td>";
                        echo"</tr>";
        }
        // Le script libérera automatiquement la mémoire et fermera la connexion
        // MySQL quand elle existe, mais faisons le quand même
        $cnxBDD->close();
        $lignes->close();
    ?> 

    </tbody>
</table>

        <p>
            <a href="FormContact.php?action=BOajout">
            <button name="ajouter" type="button" value="$trnnum" title=""><img src="./CSS/images/Plus.png"/> Ajouter</button></a>
        </p>
    </div>
</body>
</html>