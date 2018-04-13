<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && isset($_POST['userId'])) {
       
       


            $tab = array(
            "noms" => "",
            "commentaires" => "",
            "dates" => "",
            "photo" => "",
            "photoId" => 0,
            "likes" => 0
            );

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->query("SELECT * FROM commentaires WHERE Id_photo=".$_POST['photoId']);
            

            while($donnees = $requete->fetch()) {

                
                $requete2 = $bdd->query("SELECT Nom FROM utilisateurs WHERE Id=".$donnees['Id_utilisateur']."");
                
                $nom = $requete2->fetch();
               
                $commentaire = $donnees['Commentaire'];
                $date = $donnees['Date'];
                //echo $commentaire;
                
                if($tab["noms"]=="") {
                    $tab["noms"]=$nom['Nom'];
                }

                else { $tab["noms"] = $nom['Nom']  . "|" . $tab["noms"]; }

                if($tab["dates"]=="") {
                    $tab["dates"]=$date;
                }

                else { $tab["dates"] = $date . "|" . $tab["dates"] ; }
                
                if($tab["commentaires"]=="") {
                    $tab["commentaires"]=$commentaire;
                }
                else { $tab["commentaires"] =  $commentaire . "|" .  $tab["commentaires"]; }

                
                


                


            }

            $requete3 = $bdd->query("SELECT Likes,Image FROM photos WHERE Id=".$_POST['photoId']);
            $tphotos = $requete3->fetch();

            if($tab["likes"]=="") {
                if($tphotos['Likes']=="") { $tab["likes"]=0; }
                else {
                    $str = explode("|", $tphotos['Likes']);
                    $tab["likes"]=count($str);
                }
            }
            else { 
                $tab["likes"] = $tab["likes"] + count($str); }
            
            $tab["photo"] = $tphotos["Image"];
            $tab["photoId"] = $_POST['photoId'];

                
            

            echo json_encode($tab);
    }
    else {
         
        echo "Echec"; }
    

?>