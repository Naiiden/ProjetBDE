<?php
// ***** ici on récupère les données et on les stocke dans mysql

if(isset($_POST)) {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];

    $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

    $requete = $bdd->prepare("DELETE FROM membre_bde WHERE membre_bde.nom = ? AND membre_bde.prenom = ?");

                    if(!$requete->execute(array($nom, $prenom))) {
                        print_r ($requete->errorInfo());
                    } else {echo "Succes"; header("Location: bde");
                    }
}
        
?>