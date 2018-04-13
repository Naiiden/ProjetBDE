<?php

session_start();
$bdd=new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');


if  (isset($_POST['commentaire']) && isset($_POST['photoId']) ) //On check le mot de passe
{
    

    if(!$query=$bdd->exec("INSERT INTO commentaires (Id_photo, Id_utilisateur, Date, Commentaire) VALUES (" . $_POST['photoId'] . "," . $_SESSION['id'] . ",'" . date("Y-m-d H:i:s") . "','" . $_POST['commentaire'] . "')"))
        {
            print_r ($query->errorInfo());
        }

        echo 'Succes';
       

    } 
    else { //echo "email invalide";
        echo 'Error';
    }

    





?>
