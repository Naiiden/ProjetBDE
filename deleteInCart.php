<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['goodieId']) && $_POST['action']=='delete-goodie-cart') {
       
            $tab = array(
            "noms" => "",
            "descriptions" => "",
            "prix" => "",
            "id-cart" => "",
            "quantitee" => 0
            );

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->exec("DELETE FROM panier WHERE Id_utilisateur=".$_SESSION['id']." AND Id_Goodie=".$_POST['goodieId'] . " LIMIT 1;");
            $requete3 = $bdd->exec("UPDATE goodies SET QuantCom = QuantCom - 1 WHERE Id = ". $_POST['goodieId']);
            echo 'Succes';
    }
    else {
         
        echo "Echec"; }
    

?>