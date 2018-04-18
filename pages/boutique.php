<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>
<section id="boutique-list">
    <div class="inner">

        <h2 class="actu-title"> Boutique </h2>

        <div class="bloc-list-inner">

            <?php
            $reponse = $bdd->query('SELECT * FROM goodies ORDER BY Id ASC');
            $count = 0;
            while ($donnees = $reponse->fetch()) {
                if ($count < 8) {
                    ?> 

                    <div class="bloc-list-bloc">
                        <span><a href="boutique"><?php echo $donnees['Nom']; ?></a></span>
                        <div class="bloc-list-view">
                            <img src="img/local/goodie_photo/<?php echo $donnees['Image']; ?> " alt="" />
                        </div>
                        <div class="product-features">
                            <span><strong><?php echo $donnees['Prix']; ?> €</strong></span>
                            <a href="#"></a>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>

        <div class="warning"><p>Nos modèles de vêtements ne sont disponible qu'en taille unique, soit M.</p> </div>


        <?php
        if (isset($_SESSION['type'])) {
            if ($_SESSION['type'] == 2) {
                ?> 
                <div class='contact-form'>

                    <form method='POST' action="addPhotoGoodie.php" enctype="multipart/form-data">
                        <h3 id='create-event'>Ajouter un goodie</h3>
                        <div class='form-item alone'>
                            <select name="type">
                                <option selected value="0">- Type de goodies</option>
                                <option value="1">Vêtement</option>
                                <option value="2">Accessoire</option>
                            </select>
                        </div>
                        <div class="form-item">
                            <input placeholder="Nom" class="form-text item-name" name='name' type="text">
                        </div>

                        <div class="form-item">
                            <input placeholder="Description" class="form-text item-desc" name='description' type="text">
                        </div>

                        <div class="form-item">
                            <input placeholder="Prix (en chiffre uniquement)" class="form-text item-price" name='prix' type="text">
                        </div>
                        <div class="form-item">
                            <p>Image du goodie</p>
                            <input placeholder="Image" class="form-text item-image" type="file" id="file" name="image">
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                        </div>

                        <div class="form-actions">
                            <input class="validate-form" value="Valider" type="submit">
                        </div>
                    </form>
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>

