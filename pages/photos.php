<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>

<section id="photos-list">
    <div class="inner">

        <h2 class="actu-title">Photos</h2>


        <div class="photos-list-inner">

            <?php
            $reponse = $bdd->query('SELECT * FROM photos');

            while ($donnees = $reponse->fetch()) {
                ?>
                <div class="photos-list-bloc ">

                    <div class="photos-list-desc">
                        <h3> <a> <?php echo $donnees['Nom']; ?> </a></h3>
                    </div>
                    <div class="photos-list-view">
                        <span><img src= "img/local/event_photo/<?php echo $donnees['Image']; ?>" alt="" /></span>
                    </div>
                    <form method="POST" action="event.php">
                        <input type="text" value='<?php echo $donnees['Id_evenement']; ?>' name='id' style='display:none;'>
                        <input class="photo-to-event" type='submit' value="En savoir plus">
                    </form>
                </div>
            <?php }
            ?>

            <div class="downloadzip">
                <a href="DownloadZip.php"> DlZip </a>
            </div>


            <?php require TEMPLATE_PATH . 'pager.php'; ?>

        </div>

    </div>
</section>