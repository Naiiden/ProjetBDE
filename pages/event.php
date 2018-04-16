
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

<script>
function afficherCommentaires(nom,date,commentaire, commentaireId,report) {
    var text="";
    var text2="";
    var styleInfo="";
    if(report==1) {
        text="background-color:#ff8080;";
        styleInfo="color:#660000;"
        text2="<br/>Ce commentaire a été signalé par un membre du CESI ! Cliquez pour le supprimer ";
    }
   $("<div id='"+commentaireId+"' style='border-bottom:1px black dotted; padding-top:10px; padding-bottom:20px;position: relative; "+text+"'> \
    <?php if($_SESSION['type']==2) { 
        echo "<a href='#' commentId='"; 
        ?>" + commentaireId + "<?php 
        echo "' style='";?>"+styleInfo+"<?php echo ";' atitle='Supprimer ce commentaire' onclick='deleteComment("; ?>"+commentaireId+"<?php echo ")'>"; ?>"+text2+"<?php echo "</a>"; } 


        if($_SESSION['type']==3) {

            echo "<a href='#' commentId='"; 
        ?>" + commentaireId + "<?php 
        echo "' atitle='Signaler ce commentaire' class='report-comment report-comment-";?>"+commentaireId+"<?php echo"' onclick='reportComment(";
         ?>"+commentaireId+"<?php 
         echo ");'>Demander une suppression </a>";  }?>  \
                    <h2 style='float:left;'>Par " + nom + "</h2> \
                    <span style='float:right;' >Posté le <b>" +  date  + "</b></span> \
                    <br/><br/><span >" + commentaire + "</span> \
                    </div> ").appendTo('.comments-popup');
                    
}
</script>
<!-- POPUP Photo -->
<div class="popup-photo" data-popup="popup-photo" role="document">
    <div class="popup-inner-photo">
        <h3>Se connecter</h3><br/>
        <div class="photos-list-bloc ">
            <div class="photos-list-view">
                <span><img id="image-popup" src="" alt="" /></span><br/>
            </div>
        </div>
        <div class="photo-content">
        <h3 style="border-bottom:1px solid black; padding-bottom:20px;">Espace commentaire</h3>
        <a href="#"></a></div>
        <div class="comments-popup" style="margin-top:20px; margin-bottom:20px; background-color:#eff5f5; padding-left:20px; padding-right:20px;">
            <!--<div class="comment-on-photo">-->
            
            
                
            <!--</div>-->
        </div>
        <input type="text" placeholder="Laisser un commentaire" class="popup-comment">
        <input type="text" class="popup-image" value="" style="display:none;">
        <input class="button send-comment" style="margin-bottom:20px;" value="Poster" onclick="send_comment('<?php echo $_SESSION['prenom']; ?>');" type="submit">
        <a class="popup-close" data-popup-close="popup-photo" href="#">x</a>
    </div>
</div>



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
                if (($_SESSION['type'] == 1 || $_SESSION['type'] == 2)) {
                    if($reponse['Statut'] != 1) {
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
                    } elseif ($reponse['Statut']==1) { ?> <h3 style="font-size:1.5em; color: #8A1002; text-align:center;">Cet évènement est terminé !</h3><br/> <?php }
                } elseif ($_SESSION['type'] != 1 || $_SESSION['type'] == 2) {
                    ?> <h3 style="font-size:1em;">Seul les étudiants peuvent participer à cet évènement.</h3> <?php
                }
            } else {
                ?>  <a class="login" data-popup-open="popup-1" href="#"><span><h3 style="font-size:1em; color: #8A1002;">Pour participer à cet évènement, connectez-vous.</h3></span></a> <?php } ?>

            <div class="field--name-body">
                <p><?php echo $reponse['Description']; ?></p>
                
            </div>
            
            <?php if(isset($_SESSION['id'])) {
                if($reponse['Statut']==1) {
                    ?> <div class="photos-events"><h2>Photos de l'évènement</h2></div> <?php
                }
            }
            ?>
            

        </div> <?php
            // Si l'évènement est marqué comme "passé" :
            if (isset($_SESSION['id']) && isset($_SESSION['type'])) {
                if ($reponse['Statut'] == 1) {
                    ?> 


                <div class="photos-list-inner"> <?php
        $requete2 = $bdd->query('SELECT * FROM photos WHERE Id_evenement=' . $reponse['Id']);

        // On affiche chaque entrée une à une
        while ($donnees = $requete2->fetch()) {
                        ?>

                        <div class="photos-list-bloc" id="photo<?php echo $donnees['Id']; ?>"
                        <?Php 
                        if($_SESSION['type']==2 || $_SESSION['type']==3) {
                            if($donnees['Report']==1) {
                                echo " style='background-color:#ff8080;'";
                            }
                        }
                        ?>
                        
                        >
                        <?php if($_SESSION['type']==2) { ?>
                            <a class="delete-photo" href="#delete" onclick="deletePhoto(<?php echo $donnees['Id']; ?>);" title="Supprimer cette photo"></a>
                        <?php } elseif($_SESSION['type']==3) {?>
                            <a class="report-photo" href="#report" onclick="reportPhoto(<?php echo $donnees['Id']; ?>);" title="Signaler cette photo">Report </a><br/>
                        <?php } ?>
                            <div class="photos-list-desc">
                                <h3><?php echo $donnees['Nom']; ?></h3>
                            </div>
                            <div class="photos-list-view">
                                <span><img src="img/local/event_photo/<?php echo $donnees['Image']; ?>" alt="" /></span>
                            </div>
                            <h3><a class="photo" photo="<?php echo $donnees["Id"]; ?>" user="<?php echo $_SESSION['id']; ?>" data-popup-open="popup-photo" href="#">Commentaires / likes</a></h3>
                        </div>

            <?php }
        ?>
                </div>

                    <?php
                    // Récupère la lsite des isncrits à l'évènement sous forme de tableau :
                    $tabInscrits = explode("|", $reponse['Inscrits']);

                    // Si l'ID de l'utilisateur connecté en ce moment est présent dans le tableau (et donc est inscrit) :

                    if ($_SESSION['type'] == 1 && in_array($_SESSION['id'], $tabInscrits)|| $_SESSION['type'] == 2 && in_array($_SESSION['id'], $tabInscrits)) {
                        ?>
                    <div class='contact-form'>

                        <form method='POST' action="addPhoto.php" enctype="multipart/form-data">
                            <h3 id='add-photo'>Une photo à ajouter ?</h3>
                            <p>
                                Vous avez participer à cet évènement et souhaitez ajouter une photo?<br />
                                Elle sera visible sur le site automatiquement et par tout le monde !</p>

                            <div class="form-item">
                                <input placeholder="Le nom de votre photo" class="form-text event-name" name='name' type="text">
                            </div>
                            <div class="form-item">
                                <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
                                <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                            </div>
                            <div class="form-actions">

                                <input name='userId' value="<?php echo $_SESSION['id']; ?>" type="text" style="display:none;">
                                <input name='eventId' value="<?php echo $reponse["Id"]; ?>"  type="text" style="display:none;">

                                <input class="button" value="Envoyer !" type="submit">
                            </div>  
                        </form>
                    </div>  

            <?php
        }
    }


    // Sinon si l'évènement n'est pas encore passé :
    /*else {
        ?> 
                <h2 style="font-size:1.3em;"> Vous pourrez poster des photos une fois l'évènement terminé !</h2>
                <?php echo $reponse['Nom']; ?>
            <?php
            }*/
            } /*else {
            ?> 
            <h2 style="font-size:1.3em;"> Vous devez vous connecter pour voir les photos  !</h2>
            <?php
        }*/
        ?>

    </div>
</section>