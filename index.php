<!DOCTYPE html>
<html>
    <head lang=fr>
       <meta charset="utf-8">
       <title> gsb forfait </title>
     <head>
    <body>
        <?php 
            include "entete.html";
        ?>
        <div>
            <?php 
                if ( isset($_REQUEST['page']) ) 
                    {$maPage = $_REQUEST['page'];}
                else
                    {$maPage = "R";}
                                
		        switch($maPage) {
			        case 'C':{ include "./FormContact.php?action=Ajout"; break; }
			        case 'R':{ include "./FormAfficheContact.php"; break;  }
                    case 'U':{ include "./FormContact.php?action=Modif"; break;  }
                    case 'D':{ include "./DeleteContact.php"; break;  }
			    }
	        ?>
        </div>
        <?php include "pied.html"; ?>
    </body>
</html>