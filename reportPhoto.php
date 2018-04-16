<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && $_POST['action']=="reportPhoto") {
       
       

            // Verification de l'existance de l'adresse mail
            if($requete = $bdd->exec("UPDATE photos SET Report = 1 WHERE Id=".$_POST['photoId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>