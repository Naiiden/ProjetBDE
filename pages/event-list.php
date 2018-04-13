<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>




<section id="event-list">
    <div class="inner">

        <h2 class="actu-title"> évènements</h2>
        <?php
        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 2 || $_SESSION['type'] == 3) {
                ?>
                <form method="POST" action="pdf.php">
                    <div class="form-item">
                        <input placeholder="Le nom de l'évènement" class="form-text event-name" name='event' type="text">
                    </div>
                    <a href="#member-event"><input class="new-event" type="submit" value="Liste des participants à un évènement" name="new-event" /></a>
                </form>
                <a href="#create-event"><input class="new-event" type="submit" value="Créer un nouvel évènement" name="new-event" /></a>
                <?php
            }
        }
        ?>
        <div id="filter">
            <div class="filter-title">Filtrer par</div>
            <div class="filter-form">
                <ul>
                    <li><a class="active" href="#" id="sortall">Tous</a></li>
                    <li><a href="#" id="sort1">Sortie</a></li>
                    <li><a href="#" id="sort2">Sport</a></li>
                    <li><a href="#" id="sort3">Soirée</a></li>
                </ul>
            </div>
        </div>

        <div class="bloc-list-inner">

            <?php
            $reponse = $bdd->query('SELECT * FROM evenements ORDER BY Id DESC');

            while ($donnees = $reponse->fetch()) {
                ?> <div class="bloc-list-bloc <?php echo $donnees['Type']; ?>"> 
                    <span><a href="event.php"><?php
                            echo $donnees['Nom'];
                            ?> </a></span>
                    <div class="bloc-list-view">
                        <img src="img/local/events/<?php echo $donnees['Image']; ?> " alt="" />
                    </div>
                    <div class="event-fonctions">
                        <form method='post' action='event.php'>
                            <input type="text" value='<?php echo $donnees['Id']; ?>' name='id' style='display:none;'>
                            <input type='submit' value="En savoir plus">
                        </form>
                    </div>
                </div> <?php
                    }
                        ?>

        </div>

        <?php
        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 2 || $_SESSION['type'] == 3) {
                ?> 



                <div class='contact-form'>

                    <form method='POST' action="createEvent.php" enctype="multipart/form-data">
                        <h3 id='create-event'>Un nouvel évènement ?</h3>
                        <p>
                            Membre du BDE, vous pouvez créer un nouvel évènement ci-dessous.<br />
                            Il sera visible sur le site automatiquement et par tout le monde !</p>
                        <div class='form-item alone'>
                            <select name="type">
                                <option selected value="0">- Type d'évènement</option>
                                <option value="1">Sortie</option>
                                <option value="2">Sport</option>
                                <option value="3">Soirée</option>
                                <option value="4">Autre</option>
                            </select>
                        </div>


                        <div class="form-item">
                            <input placeholder="Le nom de l'évènement" class="form-text event-name" name='nom' type="text">
                        </div>
                        <div class="form-item">
                            <input placeholder="Date de l'évènement" class="textbox-n" type="text" name="date" onfocus="(this.type = 'date')"  id="date">
                        </div>
                        <div class="form-item">
                            <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                        </div>

                        <div class="form-item form-type-textarea full">
                            <textarea placeholder="Description de l'évènement" name="description" class="form-textarea idea-message"></textarea>
                        </div>
                        <div class="form-actions">
                            <input class="button" value="Envoyer !" type="submit">
                        </div>  
                    </form>
                </div>
                <?php
            }
        }
        ?>

    </div>
</section>

