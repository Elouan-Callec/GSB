<?php
include "mesFonctionsGenerales.php";

// Connexion à la base de données
$cnxBDD = connexion();

//Récupération des variables
$nom="NOM";
$idVisiteur=5;

?>

<DOCTYPE HTML>

<head>
    <meta charset="utf-8"/>
    <link type="text/css" rel="stylesheet" href="default.css" />
</head>


<body class="fond">

<div>
    <p class="fichefrais"><h1>Fiche de frais de : <?php echo $nom; ?></a> </h1></p>
</div>


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
            <th scope='col'>Date</th>
            <th scope='col'>Montant Total</th>
            <th scope='col'>État</th>
            <th scope='col'>supprimer</th>
            <th scope='col'>modifier</th>
            <th scope='col'>voir</th>
        </tr>
     </thead>
        
        <tbody>

        

            <?php
            for ($id=0; $id<=1000; $id++) {
                $sqlDate = 'SELECT mois, annee FROM FicheFrais WHERE idVisiteur='.$idVisiteur.' AND id='.$id.';';
                                        $sqlDate = $cnxBDD -> query($sqlDate);
                                        while($userData = $sqlDate -> fetch_assoc()) {
                                            $sqlDateComplete = $userData['mois'].'/'.$userData['annee'];
                                        }
                
                
                
                $sqlEtat = 'SELECT idEtat FROM ficheFrais WHERE idVisiteur='.$idVisiteur.' AND id='.$id.';';
                                        $sqlEtat = $cnxBDD -> query($sqlEtat);
                                         while($userData = $sqlEtat -> fetch_assoc()) {
                                            $sqlNumeroEtat = $userData['idEtat'];
                                        
                                            if ($sqlNumeroEtat == '1') {
                                                $idEtat = "Cloturé";
                                            } elseif ($sqlNumeroEtat == '2') {
                                                $idEtat = "En cours";
                                            } elseif ($sqlNumeroEtat == '3') {
                                                $idEtat = "Remboursé";
                                            }
                                         }
                
                $sqlDate1 = 'SELECT mois, annee, montantValide, idEtat FROM ficheFrais WHERE idVisiteur='.$idVisiteur.' AND id='.$id.';';
                                        $sqlDate1 = $cnxBDD -> query($sqlDate1);
                                        while($userData = $sqlDate1 -> fetch_assoc()) {
                
                                            echo '<tr>
                                                <td>'. $sqlDateComplete.'</td>
                                                <td>'. $userData["montantValide"].' €</td>
                                                <td>'. $idEtat.'</td>
                                                <td><a href="Delete.php?id="><img src="https://cours-informatique-gratuit.fr/wp-content/uploads/2014/05/corbeille-windows.png" width=35px height=35px></a></td>
                                                <td><a href="FormContact.php?id=&BOmodif=1"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWRISakacXylDQFihhmvVa6OgKa-j40CTq0Q&usqp=CAU" width=35px height=35px></a></td>
                                                <td></td>';
                                        }
                }
                
                
            $idVisiteur=1;
            $userReq ='SELECT * FROM visiteurmedical INNER JOIN fichefrais WHERE visiteurmedical.id=fichefrais.id ORDER BY annee;';
            //"SELECT dateModif, montantValide,idEtat,id FROM fichefrais where idVisiteur='$idVisiteur'; 
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
            <td><?php?></td>
            
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
            
                                        