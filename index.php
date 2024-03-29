<?php
include('include/common.php');
init();
if (isset($_GET['id'])) {
    echo $_GET['id'];
}
?>
<!doctype html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="description" content="<?php print $description; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
        <meta name="keywords" content="BDE,bde, cesi, exia, saint nazaire, Saint-Nazaire, école ingénieur, BDE Cesi, BDE Exia, étudiants saint nazaire,"> 
        <meta title="Site BDE CESI EXIA Saint Nazaire">
        <title><?php print $title; ?></title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.gif" type="image/x-icon">
        <link href="css/fonts.css" rel="stylesheet" type="text/css">
        <link href="css/reset.css" rel="stylesheet" type="text/css">
        <link href="css/gen/main-l.css" rel="stylesheet" type="text/css">
        <link href="css/gen/rwd-l.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,400,400i,500,700" rel="stylesheet"> 
        <link href="https://fonts.googleapis.com/css?family=Allura%7CLato:300,300i,400,400i,700,700i" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="js/main.js"></script>

    </head>

    <?php
    if ($page == "accueil") {
        echo '<body class="front">';
    } else {
        echo '<body>';
    }
    ?>

    <?php require TEMPLATE_PATH . 'header.php'; ?>

    <?php print $page_content; ?>

    <?php require TEMPLATE_PATH . 'footer.php'; ?>
</body>
</html>