<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['commentId']) && $_POST['action']=="deleteComment") {
       
       

            // Verification de l'existance de l'adresse mail
            if($requete = $bdd->exec("DELETE FROM commentaires WHERE Id=".$_POST['commentId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>