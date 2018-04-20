<?php
// ***** ici on récupère les données et on les stocke dans mysql

if(isset($_POST)) {

    $nom = $_POST['nom'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $ideaid =$_POST['id'];



    
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

    $requete = $bdd->prepare("INSERT INTO evenements (Nom,Description,Image,Type,Date,Inscrits) VALUES (?,?,?,?,?,?)");

                    if(!$requete->execute(array($nom,$description,$photo,$typebdd,$date,''))) {
                        
                        print_r ($requete->errorInfo());
                    } else {
                        if(isset($_POST['from'])) {
                            if($_POST['from']=='idea') {

                                $requete2 = $bdd->query("SELECT Email_envoyeur FROM idees WHERE Id=".$ideaid);
                                $donnee = $requete2->fetch();

                             
                                ini_set( 'display_errors', 1 );
        
                                error_reporting( E_ALL );
                            
                                $from = 'loick.legay@orange.fr';
                                

                                $to = $donnee['Email_envoyeur'];
                            
                                $subject = 'BDE EXIA';
                            
                                $message = "Bonjour, \n Nous vous informons que l'id&eacute;e que vous avez post&eacute; dans la boite à idée a &eacute;t&eacute; retenue. \n Bien jou&eacute; ! \n\n L'&eacute;quipe BDE.";
                            
                                $headers = "From:" . $from;
                            
                                mail($to,$subject,$message, $headers);
                            
                                echo "L'email a été envoyé.";

                                echo "Succes"; 
   
                            }
                        }
                        
                        
                        header("Location: event-list");
                    }
}
        
?>