<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');




if (isset($_POST['eventId']) && isset($_POST['userId'])) {
       
       

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->query("SELECT Inscrits FROM evenements WHERE Id=".$_POST['eventId']."");
                $reponse = $requete->fetch();
                $donnee =  $reponse['Inscrits'];
                

                $ids = explode("|", $donnee) ;

                unset($ids[array_search($_POST['userId'], $ids)]);

                $donnee = implode("|",$ids);

                    $sql = "UPDATE evenements SET Inscrits = :donnee WHERE Id=".$_POST['eventId']."";
                    $stmt = $bdd->prepare($sql);                                  
                    $stmt->bindParam(':donnee', $donnee, PDO::PARAM_STR);  
                    $stmt->execute(); 
                    echo "Succes";
            

        
    }
    else {
         
        echo "Echec"; }
    

?>