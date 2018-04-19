<?php

session_start();
$bdd=new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

// Date
$my_date=date("Y-m-d H:i:s");

// La date en time
$date_time=time("Y-m-d H:i:s");

# Ajout de 2h (UTC +2)
$new_date_time=$date_time+7200;

#On repasse en format date()
$new_date=date("Y-m-d H:i:s",$new_date_time);


if  (isset($_POST['commentaire']) && isset($_POST['photoId']) ) //On check le mot de passe
{
    

    $query=$bdd->prepare("INSERT INTO commentaires (Id_photo, Id_utilisateur, Date, Commentaire) 
                            VALUES (:photoid, :userid, :date, :comment )");
    
    $query->bindValue(':photoid', $_POST['photoId'], PDO::PARAM_INT);
    $query->bindValue(':userid', $_SESSION['id'], PDO::PARAM_INT);
    $query->bindValue(':date',  $new_date, PDO::PARAM_STR);
    $query->bindValue(':comment', $_POST['commentaire'], PDO::PARAM_STR);
    $query->execute();
        echo 'Succes';
       

    } 
    else { //echo "email invalide";
        echo 'Error';
    }

    





?>
