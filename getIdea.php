<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['idIdea']) && $_POST['action']=="get-idea") {
       
       

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->query("SELECT Nom, Description,Votes_utilisateurs FROM idees WHERE Id=".$_POST['idIdea']."");
            $reponse = $requete->fetch();
            $nbVotes=0;

            $votesUsersTab = explode('|', $reponse['Votes_utilisateurs']);

            if ($reponse['Votes_utilisateurs'] != "") { // Eviter l'erreur du "1" à la place du 0 votes (à refaire)
                $nbVotes = count($votesUsersTab);
            }
            

            echo $reponse['Nom'] . "|" . $reponse['Description'] . "|" . $nbVotes ."|" . $_POST['idIdea'];
        
        
    }
    else {
         
        echo "Echec"; }
    

?>