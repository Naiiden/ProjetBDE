<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>

<section id="bde">
    <div class="inner">

        <h2 class="actu-title">BDE de Saint-Nazaire</h2>

        <div id="bde-view" style="background-image: url(img/local/bde/imagepresbde.jpg)">
            <div class="claim">
                Bureau des étudiants
                <span>de Saint-Nazaire</span>
            </div>
        </div>

        <div id="bde-content">
            <div class="highlight">
                <div class="highlight-bloc">
                    <div class="highlight-view">
                        <img src="img/icons/idee.png" alt=""/>
                    </div>
                    <h3>Qu'est-ce que c'est ?</h3>
                    <p>Nous sommes une petite dizaine d'étudiants réuni en une association, élus par les étudiants du cesi afin d'organiser des évènements tous au long de l'année.</p>
                </div>
                <div class="highlight-bloc">
                    <div class="highlight-view"> 
                        <img src="img/icons/geoloc.png" alt="" />
                    </div>
                    <h3>Où nous trouver ?</h3>
                    <p>Nous sommes aux étages 4 et 5 au cesi. 1 Bd de l'Université Gavy Océanis 44600 Saint-Nazaire, France.</p>
                </div>
                <div class="highlight-bloc">
                    <div class="highlight-view">
                        <img src="img/icons/networks.png" alt=""/>
                    </div>
                    <h3>Vie associative</h3>
                    <p>Tout au long de l'année, des sorties, évènements, soirée sont organisées pour rendre votre vie à l'école plus attrayante.</p>
                </div>
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

            <section id="bde-team">
                <div class="inner">
                    <h2> L'équipe du BDE</h2>
                    <p> Primi igitur omnium statuuntur Epigonus et Eusebius ob nominum gentilitatem oppressi. praediximus enim Montium sub ipso vivendi termino his vocabulis appellatos fabricarum culpasse tribunos ut adminicula futurae molitioni pollicitos.
                    </p>

                    <div class="team-list-inner">
                        <?php
                        $reponse = $bdd->query('SELECT * FROM membre_bde ORDER BY ID_membre ASC');

                        while ($donnees = $reponse->fetch()) {
                            ?>
                            <div class="team-list-bloc">
                                <div class="team-list-view">
                                    <span><img src="img/local/bde/<?php echo $donnees['Image']; ?> " alt="" /></span>
                                </div>
                                <div class="team-list-desc">
                                    <h3><?php echo $donnees['Nom'] . "   " . $donnees['Prenom']; ?></h3>
                                    <div class="team-list-function"><?php echo $donnees['Role']; ?></div>
                                </div>
                            </div> <?php
                        }
                        ?>

                    </div>

                </div>

            </section>

            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 2) {
                    ?> 
                    <div class='contact-form'>

                        <form method='POST' action="addArticle.php" enctype="multipart/form-data">
                            <h3 id='create-event'>Ajouter un article</h3>

                            <div class="form-item">
                                <input placeholder="Nom" class="form-text article-title" name='nom' type="text">
                            </div>

                            <div class="form-item">
                                <textarea placeholder="Description de l'article" class="form-text article-desc" name='description'></textarea>
                            </div>
                            <div class="form-item">
                                <p>Image de l'article</p>
                                <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
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


            <?php
            if (isset($_SESSION['type'])) {
                if ($_SESSION['type'] == 2) {
                    ?> 
                    <div class='contact-form'>

                        <form method='POST' action="addBdeMember.php" enctype="multipart/form-data">
                            <h3 id='create-event'>Ajouter un membre du BDE</h3>

                            <div class="form-item">
                                <input placeholder="Nom" class="form-text member-name" name='nom' type="text">
                            </div>

                            <div class="form-item">
                                <input placeholder="Prénom" class="form-text member-nickname" name='prenom' type="text">
                            </div>

                            <div class="form-item">
                                <input placeholder="Rôle" class="form-text member-role" name='role' type="text">
                            </div>
                            <div class="form-item">
                                <p>Image du nouveau membre</p>
                                <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
                                <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                            </div>

                            <div class="form-actions">
                                <input class="validate-form" value="Valider" type="submit">
                            </div>
                        </form>

                        <form class="delete-member" method="POST" action="supprBdeMember.php" enctype="multipart/form-data">
                            <h3 id='create-event'>Supprimer un membre du BDE</h3>

                            <div class="form-item">
                                <input placeholder="Nom" class="form-text member-name" name='nom' type="text">
                            </div>
                            <div class="form-actions">
                                <input class="validate-form" type="submit" value="Valider" name="Supprrrrr"/>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>

