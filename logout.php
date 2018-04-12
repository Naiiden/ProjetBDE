<?php
session_start();
if (session_destroy()) {
    header("Location: index.php");
} else {
    echo 'Erreur : impossible de détruire la session, veuillez réessayer plus tard';
}