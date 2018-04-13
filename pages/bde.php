<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
?>

<section id="bde">
    <div class="inner">

        <h2 class="actu-title">BDE de Saint-Nazaire</h2>

        <div id="bde-view" style="background-image: url(img/local/view.jpg)">
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
                    <h2>Lorem Ipsum</h2>
                    <p>
                        Lorem ipsum dolor sit amet, corsuer adipiscing elit. Aenean commodo ligula eget dolo. Aenean massa. Cum sociis natoquenatibus et magnis dis parturient montes, nascetur ridiculus
                    </p>
                </div>
                <div class="highlight-bloc">
                    <div class="highlight-view"> 
                        <img src="img/icons/geoloc.png" alt="" />
                    </div>
                    <h2>Lorem Ipsum</h2>
                    <p>Lorem ipsum dolor sit amet, corsuer adipiscing elit. Aenean commodo ligula eget dolo. Aenean massa. Cum sociis natoquenatibus et magnis dis parturient montes, nascetur ridiculus</p>
                </div>
                <div class="highlight-bloc">
                    <div class="highlight-view">
                        <img src="img/icons/networks.png" alt=""/>
                    </div>
                    <h2>Lorem Ipsum</h2>
                    <p>Lorem ipsum dolor sit amet, corsuer adipiscing elit. Aenean commodo ligula eget dolo. Aenean massa. Cum sociis natoquenatibus et magnis dis parturient montes, nascetur ridiculus</p>
                </div>
            </div>

            <div class="bde-content-inner">
                <div class="content-bloc">
                    <div class="content-view">
                        <img src="img/local/view.jpg" alt=""/>
                    </div>
                    <div class="content-desc">
                        <h2>Nos missions dolor sit amet, consectetuer</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. 
                        </p>
                    </div>
                </div>
                <div class="content-bloc">
                    <div class="content-view">
                        <img src="img/local/view.jpg" alt=""/>
                    </div>
                    <div class="content-desc">
                        <h2>Nos missions dolor sit amet, consectetuer tetuer adipiscing elit.</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. 
                        </p>
                    </div>
                </div>
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
                if ($_SESSION['type'] == 3) {
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

