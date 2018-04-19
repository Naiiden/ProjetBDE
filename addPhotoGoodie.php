<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');


// ***** ici on récupère les données et on les stocke dans mysql


function checkPrice($prix) {
    if (preg_match("/^[[:digit:]]+$/", $prix)) {
        return true;
    } 
}

if (isset($_POST['name']) && isset($_POST['prix']) && isset($_POST['type']) && isset($_POST['description'])) {
    
    //$location = $_POST['location'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $typebdd = intval($_POST['type']);
    $filename = $_FILES['file']['name'];
    
    
    $dir = "img/local/goodie_photo/";

    $ext = strtolower( pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION) );
    $file=uniqid().'.'.$ext;

    if (checkPrice($prix)) {
        if(move_uploaded_file($_FILES['file']['tmp_name'],$dir . $file)){

            $requete = $bdd->prepare("INSERT INTO goodies (Nom, Description, Prix, Categorie, Image) VALUES (?,?,?,?,?)");


            if(!$requete->execute(array($name, $description, $prix, $typebdd, $file))) {
                echo "error-req-insert";
            }
            else{
                echo "Succes";
            }


            
        }
        else {
            echo "error-upload";
        }
    }
    else
    {
        echo "error-price";
    }


    

        
        
    
}
else {
    echo 'post-invalid';
}
?>