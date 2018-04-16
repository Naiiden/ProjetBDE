<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

if (isset($_POST['commentId']) && $_POST['action']=="reportComment") {
       
            $requete2 = $bdd->query("SELECT Report FROM commentaires WHERE Id=".$_POST['commentId']."");
            $donnee = $requete2->fetch();
            if($donnee['Report']=='1') {
                echo "already-report";
            }
            // Verification de l'existance de l'adresse mail
            elseif($requete = $bdd->exec("UPDATE commentaires SET Report = 1 WHERE Id=".$_POST['commentId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>