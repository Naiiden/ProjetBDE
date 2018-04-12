<?php

	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



    if (isset($_POST['idIdea']) && isset($_POST['idUser']) && ($_POST['action']=='send-vote-idea')) {
       
       

            // Verification de l'existance de l'adresse mail

            $donnee;

                $requete = $bdd->query("SELECT Votes_utilisateurs FROM idees WHERE Id=".$_POST['idIdea']."");
                $reponse = $requete->fetch();
                $donnee =  $reponse['Votes_utilisateurs'];
                
                if($donnee != "") {
                    $donnee = $donnee . '|' . $_POST['idUser'];
                } 
                elseif($donnee =="") {
                    $donnee = $_POST['idUser'];
                }

                $sql = "UPDATE idees SET Votes_utilisateurs = :donnee WHERE Id=".$_POST['idIdea']."";
                $stmt = $bdd->prepare($sql);                                  
                $stmt->bindParam(':donnee', $donnee, PDO::PARAM_STR);  
                $stmt->execute(); 


                
                 echo "Succes";

                
        
        
    }
    else {
         
        echo "Echec"; }
    

?>