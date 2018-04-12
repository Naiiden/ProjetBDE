<?php
// ***** ici on récupère les données et on les stocke dans mysql

if(isset($_POST)) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $typebdd=3;

    if($type=='1') {  $typebdd=1; }
    elseif($type=='2') {  $typebdd=2; }
    elseif($type=='3') {  $typebdd=3; }
    elseif($type=='4') {  $typebdd=4; }
    else {
        echo "veuillez choisir un type d'évènement !";
    }

    //******* On renomme l'image de manière aléatoire pour éviter un conflit dans le dossier (2 fois le même nom par exemple
    $dir = 'img/local/events/';
    $ext = strtolower( pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION) );
    $file=uniqid().'.'.$ext;
    
    //**** on bouge l'image
    move_uploaded_file($_FILES['image']['tmp_name'], $dir.$file);
    
    $photo = $file;
    
    // on enregistre les données



    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

    $requete = $bdd->prepare("INSERT INTO evenements (Nom,Description,Image,Type,Date) VALUES (?,?,?,?,?)");

                    if(!$requete->execute(array($nom,$description,$photo,$typebdd,$date))) {
                        
                        print_r ($requete->errorInfo());
                    } else {echo "Succes"; //header("Location: event-list");
                    }
}
        
?>