<?php

session_start();
$bdd=new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');


if (empty($_POST['email']) || empty($_POST['password']) ) //Oublie d'un champ
{
  /*  echo '<p>une erreur s\'est produite pendant votre identification.
                Vous devez remplir tous les champs</p>';*/
    echo "error-empty-input";
}
 
else if  (!empty($_POST['email']) || !empty($_POST['password']) ) //On check le mot de passe
{
    $nbRows = ("SELECT COUNT(*) AS nb FROM utilisateurs WHERE Email='".$_POST['email']."'");
    $result = $bdd->query($nbRows);
    $columns = $result->fetch();
    $nb = $columns['nb'];

    if($nb > 0) {
        $query=$bdd->prepare('SELECT Id, Email, Mdp, Type FROM utilisateurs WHERE Email = :email');
        $query->bindValue(':email',$_POST['email'], PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();

        if ($data['Mdp'] == $_POST['password']) // Acces OK !
        {
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $data['Id'];
            $_SESSION['type'] = $data['Type'];

            //echo '<p>Bienvenue '.$data['Email'].', vous êtes maintenant connecté!</p>';
            header("Location:accueil");
        } else {
            //echo '<p>Erreur de mot de passe</p>';
            echo "error-password";
        }

    } 
    else { //echo "email invalide";
        echo "error-email";
    }

    header("Location: index.php");
}




?>
