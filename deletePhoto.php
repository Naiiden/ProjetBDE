<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && $_POST['action']=="deletePhoto") {
       
       

            // Verification de l'existance de l'adresse mail
            if($requete = $bdd->exec("DELETE FROM photos WHERE Id=".$_POST['commentId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>