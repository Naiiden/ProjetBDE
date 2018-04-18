<?php

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
$reponse = $bdd->query('SELECT * FROM photos');
$zip = new ZipArchive();

if ($zip->open('Photos_Site.zip', ZipArchive::CREATE) == TRUE) {
    while ($donnees = $reponse->fetch()) {
        $n = -1;
        $n = $n + 1;
        $zip->addFile("img/local/event_photo/" . $donnees['Image'], "img/local/event_photo/" . $donnees['Image']);
    }
}
$zip->close();
header('Location: Photos_Site.zip');