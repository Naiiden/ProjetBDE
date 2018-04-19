<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

/* Getting file name */
$filename = $_FILES['file']['name'];
$test = $_POST['id'];

/* Location */
$location = "img/local/goodie_photo/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

// Check image format
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    $uploadOk = 0;
}

if($uploadOk == 0){
    echo "Error";
}

else
{
    /* Upload file */
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
        $requete = $bdd->exec("UPDATE goodies SET Image='".$filename."' WHERE Id = ".$test);
        //echo $test;
        echo "SUcces";
    }
    else
    {
        echo "Error";
    }
}

?>