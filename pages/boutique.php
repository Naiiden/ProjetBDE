<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '');

if(isset($_GET['test'])) {
    echo $_GET['test'];
}
?>
<style>
.table-categories {
    margin-bottom:50px;
}
table {
border: medium solid #6495ed;
border-collapse: collapse;
margin-right:auto;
margin-left:auto;

width: 87%;
}
th {
/*border: thin solid #6495ed;*/
width: 50%;
padding: 5px;
background-color: #D0E3FA;
background-image: url(sky.jpg);
}
td {
border-left: thin solid #6495ed;
border-bottom: thin solid #6495ed;
width: 50%;
padding: 5px;
text-align: center;
background-color: #ffffff;
}
</style>
<!-- POPUP AJOUTER UNE CATEGORIE --> 
<div class="popup" data-popup="popup-categorie">
            <div class="popup-inner">
            
            <table class='table-categories'>
             <tr> <th>Nom</th> <th>Action</th> </tr>
             <?php $get_categories = $bdd -> query("SELECT * FROM categories_goodies"); 
             
             while($categories = $get_categories->fetch()) { ?>
                <tr id='category<?php echo $categories['Id']; ?>'>
                    <td ><?php echo $categories['Nom']; ?></td>
                    <td ><a class="delete-category" href="#" onclick='deleteCategory(<?php echo $categories['Id']; ?>);'>Supprimer</a></td>
                </tr> <?php 

             }
              ?>
              
</table>
<table>
              <tr> <th COLSPAN=2>Ajouter une catégorie<th></tr>
              <tr> <td><input type="text" id='input-categorie' placeholder="Nom souhaité" ></td> 
              <td><input class="button" value="Ajouter !" type='submit' onclick='addCategory();'></td> </tr>
</table>
                <h2>Ajouter une catégorie</h2><br/>
               <!-- <p>
                    <input type="text" id='input-categorie' placeholder="Nom de la catégorie" >
                </p>-->
                <!--<input class="button" value="Ajouter !" type='submit' onclick='addCategory();'> -->
                <a class="popup-close" data-popup-close="popup-categorie" href="#">x</a>
            </div>
    </div>

<section id="boutique-list">
    <div class="inner">

        <h2 class="actu-title"> Boutique </h2>
        <div id="filter">
            <div class="filter-title">Catégories</div>
            <div class="filter-form">
                <ul class='' id='submenu-category'>
                
                <li><a href="#" onclick='sortShop(0);'>Tous</a></li> 
                <?php 
                $reponse = $bdd->query('SELECT * FROM categories_goodies ORDER BY Id ASC');
                while($donnee = $reponse->fetch()) {
                    ?>  <li><a href="#" onclick='sortShop(<?php echo $donnee['Id']; ?>);'><?php echo $donnee['Nom']; ?></a></li> <?php
                }

                ?>
                
                

                </ul>
            </div>
        </div>
        <input class='search-goodies' type='text' placeholder='Rechercher'/>
        <div class="bloc-list-inner" id='AllProducts'>

            <?php
            $reponse = $bdd->query('SELECT * FROM goodies ORDER BY QuantCom ASC');
            $count = 0;
            while ($donnees = $reponse->fetch()) {
                if ($count < 8) {
                    ?> 

                    <div class="bloc-list-bloc" categorieid="<?php echo $donnees['Categorie']; ?>">
                        <span><a href="boutique"><?php echo $donnees['Nom']; ?></a></span>
                        <div class="bloc-list-view">
                            <img src="img/local/goodie_photo/<?php echo $donnees['Image']; ?> " alt="" />
                        </div>
                        <div class="product-features">
                            <span><strong><?php echo $donnees['Prix']; ?> €</strong></span>
                            <a href="#" idgoodie='<?php echo $donnees['Id']; ?>' class='add-product'></a>
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

                    <!--<form method='POST' action="addPhotoGoodie.php" enctype="multipart/form-data">-->
                        <h3 id='create-event'>Ajouter un goodie</h3>
                        <div class='form-item alone'>
                            <select name="type" id='type'>
                                <option selected value="0">- Type de goodies</option>
                                <?php
                                $requete=$bdd->query("SELECT * FROM categories_goodies");

                                while($donnees2 = $requete->fetch()) {
                                    ?>
                                    
                                    <option value="<?php echo $donnees2['Id']; ?>"><?php echo $donnees2['Nom']; ?></option>

                                    <?php 
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-item">
                            <div style="position:absolute;
                                                            background: #314d61;
                                                            text-align: center;
                                                            padding: 10px 40px;
                                                            width:30%;
                                                            top: 50px;
                                                            right: 50px;">

                                <a style="color:white;" href="" data-popup-open="popup-categorie">Gérer les catégories </a>

                            </div>
                            <input placeholder="Nom" class="form-text item-name" name='name' id='name' type="text">
                        </div>

                        <div class="form-item">
                            <input placeholder="Description" class="form-text item-desc" name='description' id='description' type="text">
                        </div>

                        <div class="form-item">
                            <input placeholder="Prix (en chiffre uniquement)" class="form-text item-price" name='prix' id='prix' type="text">
                        </div>
                        <div class="form-item">
                            <p>Image du goodie</p>
                            <input placeholder="Image" class="form-text item-image" type="file" id="file" name="image">
                            <input type="hidden" name="MAX_FILE_SIZE" value="300000" >
                        </div>

                        <div class="form-actions">
                            <input class="validate-form" onclick='addGoodie();' value="Valider" type="submit">
                        </div>
                    <!--</form>-->
                </div>
                <?php
            }
        }
        ?>
    </div>
</section>

