<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && $_POST['action']=="like-photo") {
       
       

            // Verification de l'existance de l'adresse mail


            $requete = $bdd->query("SELECT Likes FROM photos WHERE Id=".$_POST['photoId']."");
            $reponse = $requete->fetch();
            $donnee =  $reponse['Likes'];
                
            if($donnee != "") {
                $donnee = $donnee . '|' . $_SESSION['id'];
            } 
            elseif($donnee =="") {
                $donnee = $_SESSION['id'];
            }

            $sql = "UPDATE photos SET Likes = :donnee WHERE Id=".$_POST['photoId']."";
            $stmt = $bdd->prepare($sql);                                  
            $stmt->bindParam(':donnee', $donnee, PDO::PARAM_STR);  
            $stmt->execute(); 
            echo "Succes";
           
            
        
        
    }
    else {
         
        echo "Echec"; }
    

?>