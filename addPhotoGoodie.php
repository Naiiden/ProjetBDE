<?php

// ***** ici on récupère les données et on les stocke dans mysql


function checkPrice($prix) {
    if (preg_match("/^[[:digit:]]+$/", $prix)) {
        return true;
    } else  echo 'error_price';
}

if (isset($_POST)) {

    $name = $_POST['name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $type = $_POST['type'];
    $typebdd = 3;

    if ($type == '1') {
        $typebdd = 1;
    } elseif ($type == '2') {
        $typebdd = 2;
    } else {
        echo "veuillez choisir un type de goodies !";
    }


    //******* On renomme l'image de manière aléatoire pour éviter un conflit dans le dossier (2 fois le même nom par exemple
    $dir = 'img/local/goodie_photo/';
    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
    $file = uniqid() . '.' . $ext;

    //**** on bouge l'image
    move_uploaded_file($_FILES['image']['tmp_name'], $dir . $file);

    $photo = $file;

    // on enregistre les données

    if (checkPrice($prix)) {

        $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

        $requete = $bdd->prepare("INSERT INTO goodies (Nom, Description, Prix, Categorie, Image) VALUES (?,?,?,?,?)");

        if (!$requete->execute(array($name, $description, $prix, $typebdd, $photo))) {

            print_r($requete->errorInfo());
        } else {
            echo "Succes";
            header("Location: boutique"); //header("Location: event-list");
        }
    }
}
?>