
<?php
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');
session_start();







if(isset($_SESSION['type'])) {
    if($_SESSION['type']==2) {


    ?>
    <!-- POPUP ACCEPETER idee -->
    <div class="popup" data-popup="popup-validate">
        <form action='createEvent.php' method='POST'  enctype="multipart/form-data">
            <div class="popup-inner">
                <h2>Vous validez cette idée ?</h2><br/>
                <p>
                <input type="text" class="name-idea" name="nom">
                <input type="text" class= '.id-idea' name='id'>
                </p>
                <p>
                    
                    <textarea class="description-idea" name="description"></textarea>
                </p><p>

                <input type="date" class="name-date" name="date">
                </p>
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
                            <input placeholder="Image" class="form-text idea-name" type="file" id="file" name="image">
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                        </div>
                <p>
                    Nombre de vote : <span class="nbvotes-idea" ></span>
                </p>
                <input value='idea' name="from" style="display:none;">
                <input type="text" class="id-idea" name="id" style="display:none;"> <!-- INput invisible pour avoir la valeur de l'id dans le form pour le php -->
                <input class="button" value="Valider cette idée" type="submit">
                <a class="popup-close" data-popup-close="popup-validate" href="#">x</a>
            </div>
        </form>
    </div>

    <?php
    }
}
    ?>


<section id="box">
    <div class="inner">

        <h2 class="actu-title">Boite à idées</h2>
        <div class="box-top">
            <div class="box-blocs" >
                <form method='POST' action=''>  <?php
                    $reponse = $bdd->query('SELECT * FROM idees');

// Boucle parcourant toutes les idées proposées

                    while ($donnees = $reponse->fetch()) {
                        ?>
                        <div class="box-bloc"> 

                            <?php if (isset($_SESSION['type'])) { 
                                if($_SESSION['type']==2) { 
                                
                            // Si un membre du BDE est connecté on affiche le bouton pour valider une idée          ?> 
                            
                            <a class="validate" validate="<?php echo $donnees["Id"]; ?>" data-popup-open="popup-validate" href="#"></a>

                                <?php } }; ?>
                            <span>

                                <?php
                                //Vérification de si l'utilisateur est connecté 

                                if (isset($_SESSION['email'])) {

                                    // On Affiche les utilisateurs ayant déjà votés
                                    $var = $donnees['Votes_utilisateurs'];

                                    // On transforme la chaine de caractère en tableau
                                    $votesUsersTab = explode('|', $var);

                                    if ($var == "") {
                                        echo 'Vote : 0';
                                    } // Eviter l'erreur du "1" à la place du 0 votes (à refaire)
                                    else {
                                        echo 'Vote : ' . count($votesUsersTab);
                                    } // On affiche le nobmre de votes

                                    /* Si l'id de l'utilisateur connecté en ce moment n'est pas présent dans les users ayant voté,
                                      On affiche le bouton de vote (+)
                                     */
                                    if (!in_array($_SESSION['id'], $votesUsersTab)) {
                                        ?>
                                        <a onclick="sendVote(<?php echo $donnees['Id'] ?>,<?php echo $_SESSION['id']; ?>);" href="#"></a>  <!-- boutton de vote-->                         <?php
                                    }
                                }
                                ?>
                            </span>
                            <div class="idea-name">Nom :  <?php echo $donnees['Nom']; ?></div><br/> 
                            Description : <?php echo $donnees['Description']; ?><br/> 
                        </div><br/>
                        <?php
                    }
                    ?>


                </form>
            </div>
        </div>

        <div class="contact-form">
            <h3>Proposez-nous une idée !</h3>
            <p>
                Pour proposer une idée, veuillez compléter le formulaire.<br />
                Le BDE sera informé d'une nouvelle idée et répondra dans les meilleurs délais.</p>
            <div class="form-item alone">
                <select>
                    <option selected>- Type d'évènement</option>
                    <option>Sortie</option>
                    <option>Sport</option>
                    <option>Soirée</option>
                    <option>Autre</option>
                </select>
            </div>

            <!-- PHP : Si connecter, mettre le nom et prénom en commentaire -->
            <div class="form-item">
                <input placeholder="Le nom de votre idée" class="form-text idea-nom" type="text">
            </div>

            <div class="form-item">
                <input placeholder="Votre email" class="form-text idea-email" type="text">
            </div>

            <div class="form-item form-type-textarea full">
                <textarea placeholder="Décrivez-nous l'idée" class="form-textarea idea-message"></textarea>
            </div>
            <div class="form-actions">
                <input class="button" value="Envoyer votre idée !" onclick="sendIdea();" type="submit">
            </div>  
        </div>
    </div>
</section>



