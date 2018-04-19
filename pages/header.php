<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
if (isset($_POST['email']) && isset($_POST['password'])) {
    echo "bonjour";
    if ($_POST['email'] == "" || $_POST['password'] == "") { //Oublie d'un champ
        /*  echo '<p>une erreur s\'est produite pendant votre identification.
          Vous devez remplir tous les champs</p>'; */
        echo "error-empty-input";
    } else if (!empty($_POST['email']) || !empty($_POST['password'])) { //On check le mot de passe
        $nbRows = ("SELECT COUNT(*) AS nb FROM utilisateurs WHERE Email='" . $_POST['email'] . "'");
        $result = $bdd->query($nbRows);
        $columns = $result->fetch();
        $nb = $columns['nb'];

        if ($nb > 0) {
            $query = $bdd->prepare('SELECT Id, Email, Mdp, Type FROM utilisateurs WHERE Email = :email');
            $query->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
            $query->execute();
            $data = $query->fetch();

            if ($data['Mdp'] == $_POST['password']) { // Acces OK !
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['id'] = $data['Id'];
                $_SESSION['type'] = $data['Type'];

                //echo '<p>Bienvenue '.$data['Email'].', vous êtes maintenant connecté!</p>';
                header("Location:accueil");
            } else {
                //echo '<p>Erreur de mot de passe</p>';
                echo "error-password";
            }
        } else { //echo "email invalide";
            echo "error-email";
        }

        header("Location: index.php");
    }
}
?>
<style>
#popup-message {
z-index:100020;
padding:0px;
width:0px;
border:1px black solid;
position:fixed;
top:30px;
z-index:1000 !important;

}

.atss {
    position: fixed;
    top: 20%;
    width: 3pc;
    z-index: 100020;
    background: none;
}
</style>

<header>

<div id="popup-message">
POPUP
</div>

    <!-- POPUP CONNEXION -->
    <div class="popup" data-popup="popup-1">
        <form action='signin.php' method='POST'>
            <div class="popup-inner">
                <h2>Se connecter</h2><br/>
                <p>
                    Votre Email :
                    <input type="email" name="email" >
                    Mot de passe : 
                    <input type="password" name="password" >
                </p>
                <input class="button" value="Se connecter" type="submit">
                <a class="popup-close" data-popup-close="popup-1" href="#">x</a>
            </div>
        </form>
    </div>

    <!-- POPUP INSCRIPTION -->
    <div class="popup" data-popup="popup-2">

        <div class="popup-inner">
            <h2>Nous rejoindre !</h2><br/>
            <p>
                Votre email :
                <input type="text" class="register-email">
            </p>
            <p>
                Votre mot de passe :
                <input type="password" class="register-password">
            </p>
            <p>
                Répétez :
                <input type="password" class="register-password-repeat">
            </p>
            <p>
                Votre nom :
                <input type="text"  class="register-name">
            </p>
            <p>
                Votre prénom :
                <input type="text"  class="register-subname">
            </p>
            <div class="button">
                <a href="#" onclick="register()" class="btn-register">S'inscrire</a>
            </div>
            <a class="popup-close" data-popup-close="popup-2" href="#">x</a>
        </div>
    </div>

    <div class="inner">
        <div id="burger"></div>

        <div id="logo">
            <a href="accueil"><img src="img/local/logoexia.png" alt="Logo Association Zone Atlantique Pornichet"></a>
        </div>

        <nav> 
            <ul>
                <?php
                if ($page == "accueil") {
                    echo '<li class="menu-item--active-trail"><a href="accueil">Accueil</a></li>';
                } else {
                    echo '<li><a href="accueil">Accueil</a></li>';
                }
                ?>
                <?php
                if ($page == "bde") {
                    echo '<li class="menu-item--active-trail"><a href="bde">L&apos;Association</a></li>';
                } else {
                    echo '<li><a href="bde">L&apos;Association</a></li>';
                }
                ?>
                <?php
                if ($page == "photos") {
                    echo '<li class="menu-item--active-trail"><a href="photos">Les photos</a></li>';
                } else {
                    echo '<li><a href="photos">Les photos</a></li>';
                }
                ?>
                <?php
                if ($page == "event.php" || $page == "event-list") {
                    echo '<li class="menu-item--active-trail"><a href="event-list">Évènements</a></li>';
                } else {
                    echo '<li><a href="event-list">Évènements</a></li>';
                }
                ?>
                <?php
                if ($page == "box") {
                    echo '<li class="menu-item--active-trail"><a href="box">Boite à idées</a></li>';
                } else {
                    echo '<li><a href="box">Boite à idées</a></li>';
                }
                ?>
                <?php
                if ($page == "boutique") {
                    echo '<li class="menu-item--active-trail"><a href="boutique">Boutique</a></li>';
                } else {
                    echo '<li><a href="boutique">Boutique</a></li>';
                }
                ?>
            </ul>
        </nav>

        <div id="header-button">
            <?php
            if (isset($_SESSION['email'])) {
                //connecté 
                
        ?>
                
                <ul>
                    <li>
                        <a class="profil" href="panier"><span>Mon panier</span></a>
                        <ul id="submenu" style="max-height:300px; overflow-y:auto;">
                            <?php
                            //$reponse = $bdd->query('SELECT Nom, Prix, Id_utilisateur FROM goodies INNER JOIN panier ON goodies.Id = panier.Id_Goodie');
                            $reponse = $bdd->query("SELECT DISTINCT Id_Goodie FROM panier WHERE Id_utilisateur=".$_SESSION['id']);
                            
                            $goodieprec=0;
                            $quantitee=1;
                            $count=0;

                            while ($donnees = $reponse->fetch()) {

                                $reponse2 = $bdd->query("SELECT COUNT(*) as nb, goodies.Id as goodieId, panier.Id as idcart, Nom, Prix, Id_utilisateur FROM goodies INNER JOIN panier ON goodies.Id = panier.Id_Goodie AND panier.Id_utilisateur=".$_SESSION['id'] . " AND panier.Id_Goodie=".$donnees['Id_Goodie']);
                                while ($donnees2 = $reponse2->fetch()) {
                                
                                    ?>
                                    
                                    <li idgoodie="<?php echo $donnees2['goodieId']; ?>">
                                        <div class="item-on-cart" idgoodie="<?php echo $donnees2['goodieId']; ?>">

                                            <?php echo $donnees2['Nom']; ?>

                                            <span class='product-price'>
                                                <?php echo $donnees2['Prix'] * $donnees2['nb'].'€';?>
                                            </span>
                                            <span style='right:40%;' class="product-quantitie">
                                            <?php echo " (x".$donnees2['nb'] .')'; ?>
                                            </span>
                                            <a href="#" onclick='deleteProduct(<?php echo $donnees2['idcart']; ?>, <?php echo $donnees2['goodieId']; ?>)'></a>
                                        </div>
                                    </li>
                                    <?php
                                    
                                }
                            }

                                $goodieprec = $donnees['goodieId'];
                                $count = $count + 1;
                            
                            ?>
                            <li><a href="panier">Accéder au panier</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="logout" href="logout"><span>Se déconnecter</span></a> 
                    </li>
                </ul>

                <?php
            } else if (!isset($_SESSION['email'])) {
                ?>
                <ul>
                    <li>
                        <a class="login" data-popup-open="popup-1" href="#"><span>Connexion</span></a>
                    </li>
                    <li>
                        <a class="register" data-popup-open="popup-2" href="#"><span>Inscription</span></a>
                    </li>
                </ul>
                <?php
            }
            ?>
        </div>

    </div>
</header>