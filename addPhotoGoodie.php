<?php

// ***** ici on récupère les données et on les stocke dans mysql


function checkPrice($prix) {
    if (preg_match("/^[[:digit:]]+$/", $prix)) {
        return true;
    } else  echo 'error-price';
}

if (isset($_POST)) {

    //$location = $_POST['location'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $type = $_POST['type'];

    $typebdd = 3;
    //echo $name;

    if ($type == '1') {
        $typebdd = 1;
    } elseif ($type == '2') {
        $typebdd = 2;
    } else {
        echo "error-type-empty";
    }



    if (checkPrice($prix)) {

        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

        $requete = $bdd->prepare("INSERT INTO goodies (Nom, Description, Prix, Categorie, Image) VALUES (?,?,?,?,?)");


        if(!$requete->execute(array($name, $description, $prix, $typebdd, ''))) {
            echo "Error";
        }
        else{

            $requete2 = $bdd->query("SELECT Id FROM goodies WHERE Nom='" . $name . "'");
            if($donnee = $requete2->fetch()) {
                echo $donnee['Id'];
            }
            else {
                echo "Error";
            }
        }
    }
}
?>