<?php
try
{

	$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

function checkPasswordUpper($password) {
    if (preg_match("#[A-Z]#", $password))
    { return true; } else echo 'error_password_uppercase';
}
function checkPasswordNumber($password) {
    if (preg_match("#[0-9]#", $password))
    { return true; } else echo 'error_password_number';
}
function checkPasswordLength($password) {
    if (strlen($password) > 6)
    { return true; } else echo 'error_password_length';
}

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['subname']) && $_POST['action']=='register') {
       
       
        if(checkPasswordUpper($_POST['password']) && checkPasswordNumber($_POST['password']) && checkPasswordLength($_POST['password'])) {
            
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            // Verification de l'existance de l'adresse mail
            $nbRows = ("SELECT COUNT(*) AS nb FROM utilisateurs WHERE Email='".$_POST['email']."'");
            $result = $bdd->query($nbRows);
            $columns = $result->fetch();
            $nb = $columns['nb'];

            if($nb > 0) {
                echo "email_invalid";
            } 
            else {
               

                $requete = $bdd->prepare("CALL `AjouterUtilisateur`(?,?,?,?)");

                if(!$requete->execute(array(htmlspecialchars($password),htmlspecialchars($_POST['email']),htmlspecialchars($_POST['name']),htmlspecialchars($_POST['subname'])))) {
                    
                    print_r ($requete->errorInfo());
                } else echo "Succes";
                
                
            }
        }
        
    }
    else {
         
        echo "Echec"; }
    

?>