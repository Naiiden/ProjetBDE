<?php

define('TEMPLATE_PATH', 'pages/');

$page = '';

$page_content = '';

$title = '';

$description = '';

function init() {
    global $page;

    $page = get_page();
    if ($page == 'contact' && !empty($_POST['email'])) {
        // formulaire a été soumit
        send_mail();
    }
    addLessSupport();
    load_content();
}

function addLessSupport() {
    require 'less/lessc.inc.php';

    $default_path = 'css/';

    $css = [
        'css/main.less' => 'css/gen/main-l.css',
        'css/rwd.less' => 'css/gen/rwd-l.css'
    ];

    foreach ($css as $source => $gen) {
        if (preg_match('/^http(.*)/', $source)) {
            $exploded = explode('/', $source);
            file_put_contents($default_path . end($exploded), file_get_contents($source));
            $source = $default_path . end($exploded);
        }

        lessc::ccompile($source, $gen);
    }
}

function get_page() {
    $quri = $_SERVER['REQUEST_URI'];
    $base_path = get_base_path();
    $page = str_replace($base_path, '', urldecode($quri));

    return $page;
}

function get_base_path() {
    $base_path = str_replace('index.php', '', $_SERVER['PHP_SELF']);
    return $base_path;
}

function set_page($new_page) {
    global $page;
    $page = $new_page;
}

function load_content() {
    global $page_content;
    global $page;
    global $title;
    global $description;

    //Déclarations des pages
    //----------------------
    $pages = array(
        'accueil' => array(
            'title' => "Bureau des étudiants",
            'file' => 'accueil.php',
        ),
        'bde' => array(
            'title' => "L'association",
            'file' => 'bde.php',
        ),
        'box' => array(
            'title' => "Boite à idées",
            'file' => 'box.php',
        ),
        'event-list' => array(
            'title' => "Événements",
            'file' => 'event-list.php',
        ),
        'event.php' => array(
            'title' => "event.php",
            'file' => 'event.php',
        ),
        'photos' => array(
            'title' => "Photos",
            'file' => 'photos.php',
        ),
        'register' => array(
            'title' => "register",
            'file' => 'register.php',
        ),
        'notice' => array(
            'title' => "notice",
            'file' => 'notice.php',
        ),
        'terms' => array(
            'title' => "Mentions légales",
            'file' => 'terms.php',
        ),
        'boutique' => array(
            'title' => "Boutique",
            'file' => 'boutique.php',
        ),
    );

    if (array_key_exists($page, $pages)) {
        $title = $pages[$page]['title'];

        //Charge la page dans la variable $page_content pour etre injecté dans l'index
        ob_start();
        include (TEMPLATE_PATH . $pages[$page]['file']);
        $page_content = ob_get_contents();
        ob_end_clean();
    } else {
        header('Location:' . get_base_path() . 'accueil');
    }
}
