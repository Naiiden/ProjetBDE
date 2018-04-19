<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && $_POST['action']=="dereportPhoto") {
       
       

            // Verification de l'existance de l'adresse mail
            if($requete = $bdd->exec("UPDATE photos SET Report = 0 WHERE Id=".$_POST['photoId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>