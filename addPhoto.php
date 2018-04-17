<?php
// ** ici on récupère les données et on les stocke dans mysql

if(isset($_POST)) {

    $name = $_POST['name'];
    $userId = $_POST['userId'];
    $eventId = $_POST['eventId'];

    //** On renomme l'image de manière aléatoire pour éviter un conflit dans le dossier (2 fois le même nom par exemple
    $dir = 'img/local/event_photo/';
    $ext = strtolower( pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION) );
    $file=uniqid().'.'.$ext;

    //** on bouge l'image
    move_uploaded_file($_FILES['image']['tmp_name'], $dir.$file);

    $photo = $file;

    // on enregistre les données



    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

    $requete = $bdd->prepare("INSERT INTO photos (Nom,Image,Id_utilisateur,Id_evenement,Likes) VALUES (?,?,?,?,?)");

                    if(!$requete->execute(array($name,$photo,$userId,$eventId,''))) {

                        print_r ($requete->errorInfo());
                    } else {echo "Succes"; header("Location: photos"); //header("Location: event-list");
                    }
}

?>