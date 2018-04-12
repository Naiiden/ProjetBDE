<?php

	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');


function checkNameLength($name) {
    if(strlen($name) > 2 || strlen($name) < 15) {
        return true; } else  { return false; echo 'error-length-name'; }

}

function checkMessageLength($message) {
    if(strlen($message) > 5 || strlen($message) < 200) {
        return true;

    } else { return false; echo 'error-length-message';}
}

    if (isset($_POST['name']) && isset($_POST['message'])) {
       
       

            // Verification de l'existance de l'adresse mail
            if(checkNameLength($_POST['name']) && checkMessageLength($_POST['message'])) {

                $requete = $bdd->prepare("CALL `EnvoyerIdee`(?,?)");

                if(!$requete->execute(array(htmlspecialchars($_POST['name']),htmlspecialchars($_POST['message'])))) {
                    print_r ($requete->errorInfo());
                } else echo "Succes";
                
            }
        
        
    }
    else {
         
        echo "Echec"; }
    

?>