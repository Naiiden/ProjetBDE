<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['photoId']) && isset($_POST['userId'])) {
       
       


            $tab = array(
            "noms" => "",
            "commentaires" => "",
            "commentairesId" => "",
            "reports" => "",
            "dates" => "",
            "photo" => "",
            "type" => "",
            "photoId" => 0,
            "likes" => 0,
            "hasLike" => 0
            );

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->query("SELECT * FROM commentaires WHERE Id_photo=".$_POST['photoId']);
            

            while($donnees = $requete->fetch()) {

                
                $requete2 = $bdd->query("SELECT Prenom FROM utilisateurs WHERE Id=".$donnees['Id_utilisateur']."");
                
                $nom = $requete2->fetch();
               
                $commentaire = $donnees['Commentaire'];
                $commentaireId = $donnees['Id'];
                $reports = $donnees['Report'];
                $date = $donnees['Date'];
                //echo $commentaire;
                
                if($tab["noms"]=="") {
                    $tab["noms"]=$nom['Prenom'];
                }

                else { $tab["noms"] = $nom['Prenom']  . "|" . $tab["noms"]; }

                if($tab["dates"]=="") {
                    $tab["dates"]=$date;
                }

                else { $tab["dates"] = $date . "|" . $tab["dates"] ; }
                
                if($tab["commentaires"]=="") {
                    $tab["commentaires"]=$commentaire;
                }
                else { $tab["commentaires"] =  $commentaire . "|" .  $tab["commentaires"]; }

                if($tab["commentairesId"]=="") {
                    $tab["commentairesId"]=$commentaireId;
                }
                else { $tab["commentairesId"] =  $commentaireId . "|" .  $tab["commentairesId"]; }

                if($tab["reports"]=="") {
                    $tab["reports"]=$reports;
                }
                else { $tab["reports"] =  $reports . "|" .  $tab["reports"]; }

                
                


                


            }

            $requete3 = $bdd->query("SELECT Likes,Image FROM photos WHERE Id=".$_POST['photoId']);
            $tphotos = $requete3->fetch();
            
                

            $ids = explode("|", $tphotos['Likes']) ;
            if(in_array($_SESSION['id'], $ids)) {
                $tab['hasLike']=1;
            }
            else {
                $tab['haslike']=0;
            } 

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
            $tab["type"] = $_SESSION['type'];
            $tab["photoId"] = $_POST['photoId'];

                
            

            echo json_encode($tab);
    }
    else {
         
        echo "Echec"; }
    

?>