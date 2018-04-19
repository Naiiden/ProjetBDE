<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
// ** ici on récupère les données et on les stocke dans mysql

if(isset($_GET['name']) && $_GET['action']=='add-category') {

    
    $requete = $bdd->exec("INSERT INTO categories_goodies (Nom) VALUES ('". $_GET['name'] ."');");
    $requete2 = $bdd->query("SELECT Id FROM categories_goodies WHERE Nom='".$_GET['name']."'");
            
    $donnees = $requete2->fetch();

   echo $donnees['Id'];


}
else {
    echo "Echec";
}


?>