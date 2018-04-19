<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>
<section id="user-cart">
    <div class="inner">

        <h2 class="actu-title"> Panier </h2>

        <div class="bloc-list-inner">

            <?php
            $reponse = $bdd->query('SELECT COUNT(*) as nb,Id_utilisateur,Nom,Image,Prix FROM goodies INNER JOIN panier ON goodies.Id = panier.Id_Goodie');
            $count = 0;
            $count3 = 0;
            while ($donnees = $reponse->fetch()) {
                if ($donnees['nb'] < 1 ) {
                    $count3 = 1;
                }
                if ($_SESSION['id'] == $donnees['Id_utilisateur']) {
                    if ($count < 8) {
                        ?> 
                        <div class="bloc-list-bloc">
                            <span><a href="boutique"><?php echo $donnees['Nom']; ?></a></span>
                            <div class="bloc-list-view">
                                <img src="img/local/goodie_photo/<?php echo $donnees['Image']; ?> " alt="" />
                            </div>
                            <div class="product-features">
                                <span><strong><?php echo $donnees['Prix']; ?> €</strong></span>
                            </div>
                        </div>
                        <?php
                    }
                }
            }
            if ($count3 == 1) {
                echo "Votre panier est vide";
            }
            ?>
        </div>
    </div>
</section>

