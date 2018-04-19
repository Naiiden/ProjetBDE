<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>

<section id="bde">
    <div class="inner">
        <div id="bde-content">
            <div class="back-link">
                <a href="bde">Retour à la liste</a>
            </div>
            <div class="bde-content-inner">

                <?php
                $reponse = $bdd->query('SELECT * FROM article_bde ORDER BY ID ASC');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <div class="content-bloc">
                        <div class="content-view">
                            <span><img src="img/local/article/<?php echo $donnees['Image']; ?> " alt="" /></span>
                        </div>
                        <div class="content-desc">
                            <h2><?php echo $donnees['Nom']; ?></h2>
                            <p><?php echo $donnees ['Description']; ?></p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>