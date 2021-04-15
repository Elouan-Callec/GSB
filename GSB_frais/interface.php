<!doctype html>

        <head>
            <title>gsb</title>
            <meta charset="utf-8"/>
            <link type="text/css" rel="stylesheet" href="default.css" />
        </head>

<?php
include "mesFonctionsGenerales.php";
$cnxBDD = connexion();
?>

<body> 


<div class="fond">
<p><h1>Fiche de frais de :</h1></p>


<p>
<a href="FormContact.php">
<img src="https://image.flaticon.com/icons/png/512/32/32360.png" class="logoajouter"></a>
</p>




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
            $userReq ='SELECT * FROM visiteurmedical INNER JOIN fichefrais WHERE visiteurmedical.id=fichefrais.idVisiteur AND visiteurmedical.id="2" ORDER BY annee;';
            $userReq = $cnxBDD -> query($userReq);
            while($userData = $userReq -> fetch_assoc()) {
            ?>
                
        <tr>
            <td><?php echo $userData ['id']; ?></td>
            <td><?php echo $userData ['nom']; ?></td>
            <td><?php echo $userData ['prenom']; ?></td>
            <td><?php echo $userData ['mois']; ?></td>
            <td><?php echo $userData ['annee']; ?></td>
            <td><?php echo $userData ['montantValide']; ?></td>
            <td><?php echo $userData ['idEtat']; ?></td>

            <td><a href="Delete.php?id= <?php echo $userData ['id']; ?>"><img src="https://cours-informatique-gratuit.fr/wp-content/uploads/2014/05/corbeille-windows.png" class='logo'></a></td>
            <td><a href="FormContact.php?id=<?php echo $userData ['id']; ?>&BOmodif=1"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWRISakacXylDQFihhmvVa6OgKa-j40CTq0Q&usqp=CAU" class='logo'></a></td>
            <td><?php echo "pas fini" ?></td>
            
            
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

<!-- 
<td>
    <a href="Delete.php?id= 
        <form action='FormContact.php' method='get'>
            <button type='submit' onclick=\"if(!confirm('Voulez-vous supprimer ce contact ?')) return false;\">
            <img src="https://cours-informatique-gratuit.fr/wp-content/uploads/2014/05/corbeille-windows.png">
            </button>
        </form>      
    </a>                                        
</td>           
            
                                        