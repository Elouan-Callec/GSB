<?php
try
{
    //Connexion a la base de donnees
    $host = "localhost";
    $servername = "gsb_frais";
    $user = "root";
    $password = "";
    $bdd = new PDO("mysql:host=$host:3306;dbname=$servername;charset=utf8", $user, $password);
}
catch (Exception $e)
{
    //Message en cas d'erreur
    die('Erreur : '.$e->getMessage());
}
?>
