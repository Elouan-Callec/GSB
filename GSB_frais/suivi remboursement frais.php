<!doctype html>

        <head>
            <title>Suivi de remboursement des frais</title>
            <meta charset="utf-8"/>
            <link type="text/css" rel="stylesheet"/>
        </head>

        <body>

            <p><h1>Fiche de frais de : </h1></p>
            <br/>
            <p><h1>Période        |Mois/Année :      </h1></p>
            <br/>
            <p><h2>Frais au forfait</h2></p>

            <div class="tableau">
                <table class="t1 t2" width="100%">
                    <thead>
                        <tr>
                            <th>Repas midi</th>
                            <th>Nuitée</th>
                            <th>Etape</th>
                            <th>Km</th>
                            <th>Situation</th>
                            <th>Date opération</th>
                            <th>Remboursement</th>
        </tr>
        </thead>
        <tbody>

            <?php
            $userReq ='SELECT * FROM visiteurmedical INNER JOIN fichefrais WHERE visiteurmedical.id=fichefrais.id ORDER BY annee;';
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

        </body

</html>