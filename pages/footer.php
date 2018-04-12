<footer>
    <div class="inner">

        <div class="logo-footer">
            <img src="img/local/exia.png" alt="Logo exia" />
            <div class="title">BDE <span>Saint-Nazaire</span></div>
        </div>

        <div class="nav-footer">
            <ul class="nav">
                <li><a href="bde">L'association</a></li>
                <li><a href="photos">Les photos</a></li>
                <li><a href="event-list">Évènements</a></li>
                <li><a href="box"> Boite à idées</a></li>
                <li><a href="boutique">Boutique</a></li>
                <?php
                if (isset($_SESSION['email'])) {
                    //connecté 
                    ?>


                    <li>
                        <a href="#"><span>Mon profil</span></a> 
                    </li>
                    <li>
                        <a href="logout"><span>Se déconnecter</span></a> 
                    </li>


                    <?php
                } else if (!isset($_SESSION['email'])) {
                    ?>

                    <li>
                        <a data-popup-open="popup-1" href="#"><span>Connexion</span></a>
                    </li>
                    <li>
                        <a data-popup-open="popup-2" href="#"><span>Inscription</span></a>
                    </li>

                    <?php
                }
                ?>

            </ul>
            <ul class="corporate">
                <li>BDE Saint-Nazaire©2018</li>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#" target="_blank">Conception : groupe 2</a></li>
            </ul>
        </div>

    </div>
</footer>