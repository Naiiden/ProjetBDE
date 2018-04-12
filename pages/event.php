
<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
if (isset($_POST['id'])) {
    $requete = $bdd->query("SELECT * FROM evenements WHERE Id=" . $_POST['id'] . "");
    $reponse = $requete->fetch();
    $date = $reponse['Date'];

    $dateDMY = explode("-", $date);
    $dateObj = DateTime::createFromFormat('!m', $dateDMY[1]);
    $monthName = $dateObj->format('F');
} else {
    header('Location: event-list');
}
?>
<section id="event">
    <div class="inner">
        <div class="event-top">
            <div class="event-view">
                <img src="img/local/events/<?php echo $reponse['Image']; ?>"/>
                <?php if ($reponse['Statut'] == 0) { ?>
                    <div class="topic">A venir</div> 
                <?php } else {
                    ?>
                    <div class="topic">Terminé</div>  <?php }
                ?>
            </div>
        </div>

        <div class="event-content">

            <div class="back-link">
                <a href="event-list">Retour à la liste</a>
            </div>

            <div class="event-date">
                <span class="day"><?php echo $dateDMY[2]; ?></span>
                <span class="month"><?php echo $monthName; ?></span>
                <span class="year"><?php echo $dateDMY[0]; ?></span>
                <span class="time">18h30</span>
            </div>
            <div class="event-published">Publié le 15 avril 2017</div>
            <h2 class="actu-title">
                <?php echo $reponse['Nom']; ?>
            </h2>

            <?php
            if (isset($_SESSION['id'])) {
                if ($_SESSION['type'] == 1) {
                    ?>

                    <div class="button">
                        <!-- <a href="" class="participe-event" >Participer à cet évènement</a>-->
                        <input style="display:none;" id="eventId" value="<?php echo $reponse['Id']; ?>">
                        <input style="display:none;" id="userId" value="<?php echo $_SESSION['id']; ?>">

                        <?php
                        $donnee = $reponse['Inscrits'];


                        $ids = explode("|", $donnee);
                        if (in_array($_SESSION['id'], $ids)) {
                            ?>
                            <input class="button unsubscribe-event" value="Se desinscrire" style="padding-bottom:0px;" type="submit"> <?php
                        } else {
                            ?>


                            <input class="button participe-event" value="Participer à cet évènement" style="padding-bottom:0px;" type="submit">
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } elseif ($_SESSION['type'] != 1) {
                    ?> <h3 style="font-size:1em;">Seul les étudiants peuvent participer à cet évènement.</h3> <?php
                }
            } else {
                ?>  <a class="login" data-popup-open="popup-1" href="#"><span><h3 style="font-size:1em; color: #8A1002;">Pour participer à cet évènement, connectez-vous.</h3></span></a> <?php } ?>

            <div class="field--name-body">
                <p><?php echo $reponse['Description']; ?></p>
                <!--
                            <h2>Lorem sip dilum sit met</h2>
                            <img style="float: right" src="img/local/events/ <?php echo $reponse['Image']; ?>"/>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus.</p>
                            <ul>
                               <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. </li>
                               <li>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</li>
                               <li>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.</li>
                               <li>Nulla consequat massa quis enim.</li>
                            </ul>-->
            </div>
            <div class="photos-events"><h2>Photos de l'évènements</h2></div>

        </div>
        <div class="photos-list-inner">

            <div class="photos-list-bloc ">
                <div class="photos-list-desc">
                    <h3><a href="photos">Nom photo</a></h3>
                </div>
                <div class="photos-list-view">
                    <span><img src="img/local/view.jpg" alt="" /></span>
                </div>
                <div class="photos-fonctions">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>

            <div class="photos-list-bloc ">
                <div class="photos-list-desc">
                    <h3><a href="photos">Nom photo</a></h3>
                </div>
                <div class="photos-list-view">
                    <span><img src="img/local/view-h.jpg" alt="" /></span>
                </div>
                <div class="photos-fonctions">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>


            <div class="photos-list-bloc ">
                <div class="photos-list-desc">
                    <h3><a href="photos">Nom photo</a></h3>
                </div>
                <div class="photos-list-view">
                    <span><img src="img/local/view.jpg" alt="" /></span>
                </div>
                <div class="photos-fonctions">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>

            <div class="photos-list-bloc ">
                <div class="photos-list-desc">
                    <h3><a href="photos">Nom photo</a></h3>
                </div>
                <div class="photos-list-view">
                    <span><img src="img/local/view-h.jpg" alt="" /></span>
                </div>
                <div class="photos-fonctions">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>

            <div class="photos-list-bloc ">
                <div class="photos-list-desc">
                    <h3><a href="photos">Nom photo</a></h3>
                </div>
                <div class="photos-list-view">
                    <span><img src="img/local/view.jpg" alt="" /></span>
                </div>
                <div class="photos-fonctions">
                    <a href="#"></a>
                    <a href="#"></a>
                </div>
            </div>

        </div>

        <div class='contact-form'>

            <form method='POST' action="createEvent.php" enctype="multipart/form-data">
                <h3 id='add-photo'>Une photo à ajouter ?</h3>
                <p>
                    Vous avez participer à cet évènement et souhaiter ajouter une photo?<br />
                    Elle sera visible sur le site automatiquement et par tout le monde !</p>


                <div class="form-item">
                    <input placeholder="Le nom de votre photo" class="form-text event-name" name='nom' type="text">
                </div>
                <div class="form-item">
                    <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                </div>
                <div class="form-actions">
                    <input class="button" value="Envoyer !" type="submit">
                </div>  
            </form>
        </div>
    </div>
</section>