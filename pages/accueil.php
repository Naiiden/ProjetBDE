<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?> 

<section id="slide">
    <div class="inner">
        <h1>
            Bureau des Étudiants
            <span>Saint-Nazaire</span>
        </h1>
    </div>
</section>


<section id="bde-events">
    <div class="inner">
        <h2 class="titleh2"> Évènements récents</h2>
        <div id="event-list-inner">

            <?php
            $reponse = $bdd->query('SELECT * FROM evenements ORDER BY Id DESC');
            $count = 0;
            while ($donnees = $reponse->fetch()) {
                if ($count < 6) {
                    ?>
                    <div class="event-list-bloc <?php echo $donnees['Type']; ?>" statut="<?php echo $donnees['Statut']; ?>">
                        <div class="event-list-view"> 
                            <img src="img/local/events/<?php echo $donnees['Image']; ?> " alt="" />
                            <?php
                            if ($donnees['Statut'] == 1) {
                                echo '<div class="topic" style="color:#C2242A;">Terminé</div>';
                            } else {
                                echo "<div class='topic' style='color:#215871;'>A venir</div>";
                            }
                            ?>
                        </div>
                        <div class="event-list-desc">
                            <h3><?php echo $donnees['Nom']; ?></h3>
                            <p><?php echo $donnees['Description']; ?></p>                
                        </div>
                        <div class="event-fonctions">
                            <form method='post' action='event.php'>
                                <input type="text" value='<?php echo $donnees['Id']; ?>' name='id' style='display:none;'>
                                <input class="more-info" type='submit' value="En savoir plus">
                            </form>
                        </div>
                    </div>
                    <?php
                    $count = $count + 1;
                }
            }
            ?>


        </div>

        <div class="all-page">
            <div class="button special">
                <a href="event-list">Voir tous les évènements</a>
            </div>
        </div>
    </div>
</section>

<!-------- PHOTOS -------->
<section class="bde-photos">
    <div class="inner">
        <h2 class="titleh2">Dernières photos</h2>

        <div class="photos-list-inner">

            <?php
            $reponse = $bdd->query('SELECT * FROM photos');
            $count = 0;
            while ($donnees = $reponse->fetch()) {
                if ($count < 4) {
                    ?>


                    <div class="photos-list-bloc ">

                        <div class="photos-list-desc">
                            <h3> <a href="#"> <?php echo $donnees['Nom']; ?> </a></h3>
                        </div>
                        <div class="photos-list-view">
                            <span><img src= "img/local/event_photo/<?php echo $donnees['Image']; ?>" alt="" /></span>
                        </div>
                        <div class="photos-fonctions">
                            <a href="#"></a>
                            <a href="#"></a>
                        </div>
                    </div>
                    <?php
                }
                }
                ?>

        </div>

        <div class="all-page">
            <div class="button special">
                <a href="photos">Toutes les photos</a>
            </div>
        </div>

    </div>
</section>

<section id="bde-boutique">
    <div class="inner">
        <h2 class="titleh2"> Top boutique </h2>
        <div class="bloc-list-inner">
            <div class="bloc-list-bloc">
                <span><a href="boutique">Nom article</a></span>
                <div class="bloc-list-view">
                    <span><img src="img/local/tshirt2.jpg" alt="" /></span>
                </div>
                <div class="product-price">prix</div>
                <a href="#"></a>
                <input type="submit" value="Ajouter au panier" name="add-cart" />
            </div>

            <div class="bloc-list-bloc">
                <span><a href="boutique">Nom article</a></span>
                <div class="bloc-list-view">
                    <span><img src="img/local/tshirt2.jpg" alt="" /></span>
                </div>
                <div class="product-price">prix</div>
                <input type="submit" value="Ajouter au panier" name="add-cart" />
            </div>

            <div class="bloc-list-bloc">
                <span><a href="boutique">Nom article</a></span>
                <div class="bloc-list-view">
                    <span><img src="img/local/tshirt2.jpg" alt="" /></span>
                </div>
                <div class="product-price">prix</div>
                <input type="submit" value="Ajouter au panier" name="add-cart" />
            </div>

            <div class="bloc-list-bloc">
                <span><a href="boutique">Nom article</a></span>
                <div class="bloc-list-view">
                    <span><img src="img/local/tshirt2.jpg" alt="" /></span>
                </div>
                <div class="product-price">prix</div>
                <input type="submit" value="Ajouter au panier" name="add-cart" />
            </div>
        </div>

        <div class="all-page">
            <div class="button special">
                <a href="boutique">Accéder à la boutique</a>
            </div>
        </div>
    </div>
</section>

