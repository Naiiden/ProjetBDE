<?php

	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');


    if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['id'])) {
       
       

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->prepare("CALL `EnvoyerIdee`(?,?)");

            if(!$requete->execute(array(htmlspecialchars($_POST['name']),htmlspecialchars($_POST['message'])))) {
                print_r ($requete->errorInfo());
            } else echo "Succes";
                
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>