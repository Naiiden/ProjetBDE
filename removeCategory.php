<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
// ** ici on récupère les données et on les stocke dans mysql

if(isset($_POST['id']) && $_POST['action']=='remove-category') {

    
    $requete = $bdd->query("SELECT COUNT(*) as nb FROM goodies WHERE Categorie = ".$_POST['id']);
    $donnee = $requete->fetch();

    if($donnee['nb'] == 0) {
        if($requete2 = $bdd->exec("DELETE FROM categories_goodies WHERE Id=". $_POST['id'])) {
            echo "Succes";
        }
        else {
            echo "Error";
        }
    }
    else {
        echo 'error-goodie';
    
    }

    
            


}
else {
    echo "Echec";
}


?>