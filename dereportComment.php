<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

if (isset($_POST['commentId']) && $_POST['action']=="dereportComment") {
       
            $requete2 = $bdd->query("SELECT Report FROM commentaires WHERE Id=".$_POST['commentId']."");
            $donnee = $requete2->fetch();
            if($donnee['Report']=='0') {
                echo "already-dereport";
            }
            // Verification de l'existance de l'adresse mail
            elseif($requete = $bdd->exec("UPDATE commentaires SET Report = 0 WHERE Id=".$_POST['commentId']."")) {
                echo "Succes";
            }
            else {
                echo "Echec";
            }
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>