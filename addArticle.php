<?php
// ***** ici on récupère les données et on les stocke dans mysql

if(isset($_POST)) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];



    //******* On renomme l'image de manière aléatoire pour éviter un conflit dans le dossier (2 fois le même nom par exemple
    $dir = 'img/local/article/';
    $ext = strtolower( pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION) );
    $file=uniqid().'.'.$ext;
    
    //**** on bouge l'image
    move_uploaded_file($_FILES['image']['tmp_name'], $dir.$file);
    
    $photo = $file;
    
    // on enregistre les données



    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

    $requete = $bdd->prepare("INSERT INTO article_bde (Nom,Description,Image) VALUES (?,?,?)");

                    if(!$requete->execute(array($nom,$description,$photo))) {
                        
                        print_r ($requete->errorInfo());
                    } else {echo "Succes"; header("Location: bde");
                    }
}
        
?>