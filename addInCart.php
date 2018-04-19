<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');



if (isset($_POST['goodieId']) && $_POST['action']=='add-goodie-cart') {
       
            $tab = array(
            "noms" => "",
            "descriptions" => "",
            "prix" => "",
            "id-cart" => "",
            "quantitee" => 0
            );

            // Verification de l'existance de l'adresse mail
            $requete = $bdd->exec("INSERT INTO panier (Id_utilisateur, Id_Goodie) VALUES (". $_SESSION['id'] .",". $_POST['goodieId'] .");");
            $requete3 = $bdd->exec("UPDATE goodies SET QuantCom = QuantCom + 1 WHERE Id = ". $_POST['goodieId']);


            $requete2 = $bdd->query('SELECT COUNT(*) as nb, panier.Id as idcart, Nom, Prix, Id_utilisateur FROM goodies INNER JOIN panier ON goodies.Id = panier.Id_Goodie AND panier.Id_utilisateur='.$_SESSION['id'].' AND panier.Id_Goodie='.$_POST['goodieId']);
            
            $donnees = $requete2->fetch();

                $tab["noms"] = $donnees['Nom'];
                $tab["prix"] = $donnees['Prix'];
                $tab["quantitee"] = $donnees['nb'];
                $tab["id-cart"] = $donnees['idcart'];

            


            echo json_encode($tab);
    }
    else {
         
        echo "Echec"; }
    

?>