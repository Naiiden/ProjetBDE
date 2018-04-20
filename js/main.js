 photo = 0;
 likes = 0;
 var hasLike=0;


function message(text) {
    alert('message');
    $('.popup-message').html(message);
    $(".popup-message").animate({
        width: "20%",
        opacity: 1
      }, 200 );
}

function getDate() {
     d = new Date();

    month = d.getMonth()+1;
    day = d.getDate();
    heure = d.getHours();
    minute = d.getMinutes();
    seconde = d.getSeconds();

 output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day + " " + heure+":"+minute+":"+seconde ;
    return output;
}

$(document).ready(function() {
    //Le code ici
    $(function() {
        //----- FERMER POPUP
            $('[data-popup-open]').on('click', function(e)  {
            targeted_popup_class = jQuery(this).attr('data-popup-open');
            $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
            $('html').addClass('popup-open');
            e.preventDefault();

        });

        //----- FERMER POPUP
            $('[data-popup-close]').on('click', function(e)  {
            targeted_popup_class = jQuery(this).attr('data-popup-close');
            $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
            $(".comments-popup").children().remove();
            $('html').removeClass('popup-open');
            e.preventDefault();
        });

        // Quand on valide une idée
            $('.validate').on('click', function(e)  {
            
                
                $.post('getIdea.php', 
                {
                    idIdea: $(this).attr('validate'),
                    action: 'get-idea'
                },
                
                function(data) {
                    if(data!='Echec') {
                        tab=data.split("|");

                        $(".name-idea").val(tab[0]);
                        $(".description-idea").text(tab[1]);
                        $(".nbvotes-idea").text(tab[2]);
                        $(".id-idea").val(tab[3]);

                    }
                    else if(data=='Echec') {
                        alert("Erreur ...");
                    }
                    
                },

                'text'
                );
                $('#id_vote').html = "";
        });

        // Quand on clique sur une photo (event.php)
            
            $('.photo').on('click', function(e)  {
                alert('test');
                $.post('getCommentsLikes.php', 
                {
                    photoId: $(this).attr('photo'),
                    userId: $(this).attr('user')
                },
                
                function(data) {
                    if(data!='Echec') {
                         
                        // On récupère le tableau JSON du php 
                        json = JSON.parse(data);

                        // On change la source de l'image par les infos venant de la base de donnée (dans getComentLike)
                        $("#image-popup").attr("src","img/local/event_photo/"+json['photo']);

                        // On remplis les infos dans des variables
                        commentaires = json['commentaires'].split('|');
                        commentairesId = json['commentairesId'].split('|');
                        reports = json['reports'].split('|');
                        noms = json['noms'].split('|');
                        photoId = json['photoId'];
                        type = json['type'];
                        likes= json['likes'];
                        dates =json['dates'].split('|');
                        hasLike =json['hasLike'];
                        
                    i = 0;

                    if(noms[0]!="") {

                    noms.forEach(function() { // Pour chaque nom dans la table commentaire

                        // On affiche les commentaires
                        afficherCommentaires(noms[i],dates[i],commentaires[i], commentairesId[i], reports[i],type);
                        i = i + 1;
                    });
                    }
                    else { // SInon on affiche 'il n'y a encore aucun commentaires !
                        $("<h2 style='color:rgb(99, 0, 0);'>Il n'y a encore aucun commentaire !</h2>").appendTo('.comments-popup');
                    }

                    photo=photoId;

                    // LIKE
                    $('.btn-like').html(likes+"&nbsp;&nbsp;");
                    if(hasLike==1) { // SI l'utilisateur connecté a déjà liké 

                        $('.btn-like').addClass('active-btn-click'); // On change le style du boutton j'aime 
                    }else {
                        $('.btn-like').removeClass('active-btn-click');
                    }

                        


                    }
                    else if(data=='Echec') {
                        //alert("Erreur ...");
                    }
                    
                },

                'text'
                );
                $('#id_vote').html = "";

        
            });

    });

    // Ouverture de l'espace commentaire / like de chaque photo


   

    // ----- TRIER PAR SORTIE
        $( "#sort1" ).click(function() {
            $('div#event-list-inner>div').each(function(){ 
                
                if(!$(this).hasClass("1")) {
                    $(this).css({"display": "none"});
                

                    
                }  else { $(this).css({"display": "block"}); }
                if($('#sort4').hasClass('active')) {
                    if($(this).attr('statut')!="0") {
                        $(this).css({"display": "none"});
                    }
                }
                if($('#sort5').hasClass('active')) {
                    if($(this).attr('statut')!="1") {
                        $(this).css({"display": "none"});
                    }
                }
         });

       
        $("#sortall").removeClass( "active" );
        $("#sort1").addClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").removeClass( "active" );

        $(this).addClass("active");
    });

    // ---- TRIER PAR SORTIE
        $( "#sort2" ).click(function() {
        $('div#event-list-inner>div').each(function(){ 
            
            if(!$(this).hasClass("2")) {
                
                $(this).css({"display": "none"});
                
            } else { $(this).css({"display": "block"}); }
        
        
            if($('#sort4').hasClass('active')) {
                if($(this).attr('statut')!="0") {
                    $(this).css({"display": "none"});
                }
            }
            if($('#sort5').hasClass('active')) {
                if($(this).attr('statut')!="1") {
                    $(this).css({"display": "none"});
                }
            }
        
        
        });
        
        $("#sortall").removeClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").addClass( "active" );
        $("#sort3").removeClass( "active" );
    });

    // ----- TRIER PAR SPORT
        $( "#sort3" ).click(function() {
        $('div#event-list-inner>div').each(function(){ 
            
            if(!$(this).hasClass("3")) {
                $(this).css({"display": "none"});
                
            } else { $(this).css({"display": "block"}); }
            if($('#sort4').hasClass('active')) {
                if($(this).attr('statut')!="0") {
                    $(this).css({"display": "none"});
                }
            }
            if($('#sort5').hasClass('active')) {
                if($(this).attr('statut')!="1") {
                    $(this).css({"display": "none"});
                }
            }
        });
        
        $("#sortall").removeClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").addClass( "active" );
    });

    // ----- trier par TOUS
        $( "#sortall" ).click(function() {
        $('div#event-list-inner>div').each(function(){ 
            
            
                $(this).css({"display": "block"});
                if($('#sort4').hasClass('active')) {
                    if($(this).attr('statut')!="0") {
                        $(this).css({"display": "none"});
                    }
                }
                if($('#sort5').hasClass('active')) {
                    if($(this).attr('statut')!="1") {
                        $(this).css({"display": "none"});
                    }
                }
        
        });
        
        $("#sortall").addClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").removeClass( "active" );
    });



    // Trier que les évènement à venir

        $( "#sort4" ).click(function() {
        $('div#event-list-inner>div').each(function(){ 
            
            

                if($(this).attr('statut')=="0") {
                    $(this).css({"display": "block"});
                    
                    if($('#sort1').hasClass('active')) {
                        if(!$(this).hasClass('1')) {
                            $(this).css({"display": "none"});
                        }
                    } 
                    if($('#sort2').hasClass('active')) {
                        if(!$(this).hasClass('2')) {
                            $(this).css({"display": "none"});
                        }
                    } 
                    if($('#sort3').hasClass('active')) {
                        if(!$(this).hasClass('3')) {
                            $(this).css({"display": "none"});
                        }
                    }  
                }
                else if( $(this).attr('statut')=="1") {
                    $(this).css({"display": "none"});
                }
        });
        
        $("#sort4").addClass( "active" );
        $("#sort5").removeClass( "active" );
    });
    
    // trier par les évènement passé
        $( "#sort5" ).click(function() {
        $('div#event-list-inner>div').each(function(){ 
            
            
                
                if($(this).attr('statut')=="1") {
                    $(this).css({"display": "block"});
                    if($('#sort1').hasClass('active')) {
                        if(!$(this).hasClass('1')) {
                            $(this).css({"display": "none"});
                        }
                    } 
                    if($('#sort2').hasClass('active')) {
                        if(!$(this).hasClass('2')) {
                            $(this).css({"display": "none"});
                        }
                    } 
                    if($('#sort3').hasClass('active')) {
                        if(!$(this).hasClass('3')) {
                            $(this).css({"display": "none"});
                        }
                    }  
                }
                else if( $(this).attr('statut')=="0") {
                    $(this).css({"display": "none"});
                }
        });
        
        $("#sort5").addClass( "active" );
        $("#sort4").removeClass( "active" );
    });

    // Autocompletion de la boutique

        $('.search-goodies').on('input',function(e){
        if($(this).val() != "") {
            $('#AllProducts').children('div').children('span').children('a').each(function() {
                
                $(this).parent('span').parent('div').css('display','none');
                test = $(this).html();
                i = test.indexOf($('.search-goodies').val());
                if(i >= 0){

                    $(this).parent('span').parent('div').css('display','block');
                    
                }
                $(this).parent('span').parent('div').nextAll('div').css('display','none');
                
            });
        }
        else {
            $('#AllProducts').children('div').each(function() {
                $(this).css('display','block');
            });
        }
    });




    // AJOUTER UN PRODUIT AU PANIER 
        $('.add-product').click(function() {
        var idgoodie=$(this).attr('idgoodie');
        
        $.post('addInCart.php', 
        {
            goodieId: idgoodie,
                action: 'add-goodie-cart'
        },
        function(data) {
            if(data!='Echec') {

                // On récupère le talbeau php en JSON
                json = JSON.parse(data);

                // On défini les variables
                var nom = json['noms'];
                var prix = json['prix'];
                var quantite = json['quantitee'];
                var id_cart = json['id-cart'];

                // Pour chaque produit dans le panier
                $('#submenu').children('li').each(function(){ 
                    if($(this).attr('idgoodie')==idgoodie) { // Si il existe déjà un goodie 
                        $(this).remove(); // On l'enlève ... 
                        
                    }
               });
            
               // .... Puis on affiche le goodie commandé

               $("<li idgoodie='"+idgoodie+"'> \
                                    <div class='item-on-cart' idgoodie='"+ idgoodie +"'>\
                                        "+nom+"\
                                        <span class='product-price'>\
                                            "+ (prix*quantite) +"€\
                                        </span>\
                                        <span style='right:40%;' class='product-quantitie'>\
                                        (x"+quantite+")\
                                        </span>\
                                        <a href='#' onclick='deleteProduct("+id_cart+", "+idgoodie+");'></a>\
                                    </div>\
                                </li>").prependTo('#submenu');

             
            }
            else {
                aert('Echec !');
            }
        },
        'text'
        );
        
    });

    // PARTICIPER A UN EVENEMENT
   
        $( ".participe-event" ).click(function() {
        //eventId
        $.post('participeEvent.php', 
        {
            eventId: $("#eventId").val(),
            userId: $("#userId").val()
        },
        
        function(data) {

            if(data=='Echec') {
                alert("erreur.");
            }
            else if(data=='error-already-registered') {
                alert("Vous êtes déjà inscrit...");
            }
            else if(data=='Succes') {
                alert("Vous êtes inscrit !");
                window.location.href = "event-list";
            }
        },

        'text'
    );
    });




    // On enlève le signalement d'une photo (membre BDE)
        $(".dereport-photo").click(function() {
        var photoIdForm = $(this).attr('photo');
        $.post('dereportPhoto.php', 
                            {
                                photoId: photoIdForm,
                                action: "dereportPhoto"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    
                                    
                                    $(this).remove();
                                    $("#photo"+photoIdForm).css("background-color","#f3f4f4");
                                    alert("Vous avez enlevé le signalement ! ");
                                    
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
       
    });

    
    // On se désinscrit d'un évènement (compte UTILISATEUR)
        $( ".unsubscribe-event" ).click(function() {
        $.post('unsubscribeEvent.php', 
        {
            eventId: $("#eventId").val(),
            userId: $("#userId").val()
        },
        
        function(data) {

            if(data=='Echec') {
                alert("erreur.");
            }
            else if(data=='Succes') {
                alert("Vous vous êtes désinscrit !");
                window.location.href = "event-list";
            }
        },

        'text'
        );
    });

});


/* ----------------------------------------- */
/* ------------ FUNCTIONS -------------------*/
/* ----------------------------------------- */






                        /*--------- PAGE PHOTOS ---------*/


// Liker une photo (TOUS LES MEMBRES)
    function likePhoto() {

    if(hasLike==0) {
        hasLike=1;
        $.post('likePhoto.php', 
                            {
                                photoId: photo,
                                action: "like-photo"
                            },
                            
                            function(data) {
                                if(data=='Succes') {

                                    likes = likes + 1;
                                    
                                    $('.btn-like').html(likes+"&nbsp;&nbsp;");
                                    $('.btn-like').addClass('active-btn-click');
                                    
                                    
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );

                    }
}


// Supprimer une photos (MEMBRE BDE)
    function deletePhoto(photoIdForm) {
    $.post('deletePhoto.php', 
                            {
                                photoId: photoIdForm,
                                action: "deletePhoto"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    
                                    $("#photo"+photoIdForm).css("background-color","#ff8080");
                                    $("#photo"+photoIdForm).fadeOut( "slow", function() {
                                        // After animation completed:
                                        $("#photo"+photoIdForm).remove();
                                    });
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
}

// Signaler une photo (MEMBRE CESI)
    function reportPhoto(photoIdForm) {
    $.post('reportPhoto.php', 
                            {
                                photoId: photoIdForm,
                                action: "reportPhoto"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    
                                    $("#photo"+photoIdForm).css("background-color","#ff8080");
                                    
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
}

// Signaler un commentaire (MEMBRE CESI)
    function reportComment(commentIdForm) {
   $.post('reportComment.php', 
                            {
                                commentId: commentIdForm,
                                action: "reportComment"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    $("#"+commentIdForm).css("background-color","#ff8080");
                                    $('.report-comment-'+commentIdForm).html('Les membres du BDE ont été informé !')
                                }
                                else if(data=="already-report") {
                                    alert("Vous avez déjà signalé ce commentaire !");
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
}

// Enlever un signalement d'un commentaire (MEMBRE BDE)

    function dereportComment(commentIdForm) {
    $.post('dereportComment.php', 
                            {
                                commentId: commentIdForm,
                                action: "dereportComment"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    $("#"+commentIdForm).css("background-color","#eff5f5");
                                    $("#"+commentIdForm).children('.delete-comment-a').css("color","#3897c1");
                                    $("#"+commentIdForm).children('.dereport-comment-a').remove();
                                    //$('.report-comment-'+commentIdForm).html('Les membres du BDE ont été informé !')
                                }
                                else if(data=="already-dereport") {
                                    alert("Vous avez déjà signalé ce commentaire !");
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
}

// Envoyer un commentaire (TOUS LES MEMBRES)
    function send_comment(nomForm) {
    $.post('sendComment.php', 
                            {
                                commentaire: $('.popup-comment').val(),
                                photoId: photo
                                
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                        $('.comments-popup').prepend("<div style='border-bottom:1px black dotted; padding-top:10px; padding-bottom:20px;'> \
                                        <h2 style='float:left;'>Par " + nomForm  + "</h2> \
                                        <span style='float:right;' >Posté le <b>"+ getDate() + "</b></span> \
                                        <br/><br/><span >" + $('.popup-comment').val() +"</span> \
                                        </div>");
            
                                }
                                else if(data=='Echec') {
                                    alert("Erreur...");
                                }
                                
                            },
        
                            'text'
                        );
        

}


// Supprimer un commentaire (MEMBRE BDE)
    function deleteComment(commentIdForm) {
    $.post('deleteComment.php', 
                            {
                                commentId: commentIdForm,
                                action: "deleteComment"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    //alert("Vous avez bien supprimé le commentaire.");
                                    
                                    $("#"+commentIdForm).css("background-color","#ff8080");
                                    $("#"+commentIdForm).fadeOut( "slow", function() {
                                        // After animation completed:
                                        $("#"+commentIdForm).remove();
                                    });
                                }
                                else if(data=='Echec') {
                                    //alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
    //$('div').remove("#"+commentIdForm);
}


                        /*--------- PAGE BOITE A IDEE ---------*/


// Envoyer une idée dans la boite à idée (TOUS LES MEMBRES)
    function sendIdea() {
    alert($('.idea-email').val());

    if($(".idea-nom").val() != "") {
        if($('.idea-email').val() != "") {
            if($(".idea-message").val() != "")  {

                $.post('sendIdea.php', 
                            {
                                name: $(".idea-nom").val(),
                                message: $(".idea-message").val(),
                                email: $('.idea-email').val(),
                                action: 'send-idea'
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    alert("Votre idée a été transmise au BDE !");
            
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                
                            },
        
                            'text'
                        );
            } else alert("Veuillez renseigner un message !");
        } else alert("Veuillez renseigner votre email !");
    } else alert("Veuillez renseigner votre nom !");
}

// Envoyer un vote (TOUS LES MEMBRES)
    function sendVote(idIdeaForm,idUserForm) {
    $.post('sendVoteIdea.php', 
                            {
                                idIdea: idIdeaForm,
                                idUser: idUserForm,
                                action: 'send-vote-idea'
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    alert("Merci de votre vote ! ");
                                    location.reload(); 
            
                                }
                                else if(data=='Echec') {
                                    alert("Erreur lors du vote ...");
                                }
                                
                            },
        
                            'text'
                        );
        $('#id_vote').html = "";
}


                        /*--------- PAGE BOUTIQUE ---------*/


// Ajouter une catégorie (Membre BDE)
    function addCategory(){
        $( ".popup-message" ).animate({
            width: "20%",
            opacity: 0.4
        }, 300 );

        var nameForm = $('#input-categorie').val(); 

        $.post('addCategory.php', 
            {
                name: nameForm,
                action: 'add-category'
            },
            function(data) {
                if(data!='Succes') {
                    $("<tr id='category"+data+"'><td>"+nameForm+"</td><td><a class='delete-category' onclick='deleteCategory("+data+");' href='#'>Supprimer</a></td></tr>").appendTo('.table-categories');
                    $("<li><a href='#' onclick='sortShop("+data+")'>"+nameForm+"</a></li>").appendTo('#submenu-category');
                }
                else if(data=="Echec") {
                    alert('error');
                }
                
            },
            'text'
        );
}

// Supprimer une catégorie (MEMBRE BDE)
    function deleteCategory(categoryId) {

            $.post('removeCategory.php', 
            {
                id: categoryId,
                action: 'remove-category'
            },
            function(data) {
                if(data=='error-goodie') {
                    alert("Impossible de supprimer la catégorie car des goodies l'utilisent déjà !"); 
                }
                else if(data=="Echec") {
                    alert('error');
                }
                else if(data=="Succes") {
                    alert("La catégorie a bien été supprimée !");
                    $('#category'+categoryId).remove();
                }
                
            },
            'text'
        );
}

// Ajouter un produit à vendre (MEMBRE BDE)
    
    function addGoodie () {

        
        if(document.getElementById("file").files.length != 0 ){
            if(($('#name').val()!="")) {
            


            var fd = new FormData();
            var files = $('#file')[0].files[0];
            fd.append('file',files);
            fd.append('name',$('#name').val());
            fd.append('prix',$('#prix').val());
            fd.append('description',$('#description').val());
            fd.append('type',$('#type').val());

            $.ajax({
                url: 'addPhotoGoodie.php',
                    type: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response=='post-invalid') {
                            alert('erreur !')
                        }
                        else if(response== 'error-price') {
                            alert('veuillez entrer un prix valide !')
                        }
                        else if(response=="error-upload") {
                            alert("Erreur lors de l'upload de l'image !")
                        }
                        else if(response=='error-req-insert') {
                            alert("Erreur SQL !")
                        }
                        else if(response=='Succes') {
                            alert("Votre goodie a été ajouté !");
                        }
                    },
                });
            }

            else 
            {
                alert('Veuillez renseigner un nom !');
            }
        }
        else {
        alert("Veuillez charger une image !");
        }
        

}

// Trier la boutique 
    function sortShop(idCategorie) { // idCategorie : correspond au tri que l'on veut (directement de la base de donnée)
    
        if(idCategorie==0) {
            $('#AllProducts').children('div').each(function(){
                $(this).css('display','block');
            });
        }
        else {
        $('#AllProducts').children('div').each(function(i){

            if($(this).attr('categorieid') != idCategorie) {
                $(this).fadeOut( "slow", function() {
                $(this).css('display','none');
                });
            }

            else {
                $(this).fadeIn("slow", function() {
                $(this).delay(2000).css('display','block');
                });
            }
        });
    }

}

// Supprimer un produit du panier
    function deleteProduct(idcart,idgoodie) {

    $.post('deleteInCart.php', 
        {
            goodieId: idgoodie,
                action: 'delete-goodie-cart'
        },
        function(data) {
            if(data=='Succes') {

                $('#submenu').children('li').each(function(){
                    if($(this).attr('idgoodie')==idgoodie) {
                        var price;
                        var quantitie;
                        var quant;
                        $(this).children('div').children('span').each(function(i){
                            if($(this).hasClass('product-price')) {
                                price = $(this).html().replace(/\D+/g,'');
                            }
            
                            else if($(this).hasClass('product-quantitie')) {
                                quantitie=$(this).html().replace(/\D+/g,'');
                            }
                        });
                        quant = parseInt(quantitie);
                        if(quant==1) {
                            $(this).remove();
                        }
                        else {
                            quant = quant - 1;
                            $(this).children('div').children('span').each(function(i){
            
                                if($(this).hasClass('product-quantitie')) {
                                    $(this).html('(x'+quant+')');
                                }
                            });
                        }
                        
                    }
                });
            }
            else if(data=="Echec") {
                alert('error');
            }
        },
        'text'
        );


}



// ----------------- INSCRIPTION ------------------------
    function register() {
    if($(".register-email").val() != "") {
        if($(".register-password").val() != "" && $(".register-password-repeat").val() != "") {
            if($(".register-password").val() == $(".register-password-repeat").val()) {
                if($(".register-name").val() != "") {
                    if($(".register-subname").val() != "") {


                        $.post('signup.php', 
                            {
                                email: $(".register-email").val(),
                                name: $(".register-name").val(),
                                subname: $(".register-subname").val(),
                                password: $(".register-password").val(),
                                action: 'register'
                            },
                            
                            function(data) {
                            if(data=='Succes') {
                                $('[data-popup=popup-2]').fadeOut(350);
                                alert("Vous êtes inscrit !");
                                
                                }
                                else if(data=='Echec') {
                                alert("erreur.");
                                }
                                else if(data=='email_invalid') {
                                    alert("Adresse email déjà utilisée ! ");
                                }
                                else if(data=='error_password_uppercase') {
                                    alert("Votre mot de passe doit contenir au moins une majuscule !");
                                }
                                else if(data=='error_password_number') {
                                    alert("Votre mot de passe doit contenir au moins un chiffre !");
                                }
                                else if(data=='error_password_length') {
                                    alert("Votre mot de passe doit faire au moins 6 caractères !");
                                }
                                
                            },
        
                            'text'
                        );


                    } else alert("Veuillez renseigner votre prénom !");
                } else alert("Veuillez renseigner votre nom !");
            } else alert("Vos mot de passe ne correspondent pas !");
        } else alert("Veuillez renseigner un mot de passe !");
    } else alert("Veuillez renseigner une adresse mail !");
    
}

// ------------------ CONNEXION ----------------------------
    function login() {

                        $.post('signin.php', 
                            {
                                email: $("#email").val(),
                                password: $("#password").val()
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    alert("Vous êtes connecté !");
                                    //$('[data-popup=popup-1]').fadeOut(350);
                                    
                                }
                                else if(data=='Echec') {
                                    alert("erreur.");
                                }
                                else if(data=='error-empty-input') {
                                    alert("Veuillez remplir tous les champs ! ");
                                }
                                else if(data=='error-password') {
                                    alert("Votre mot de passe est incorrect ! ");
                                }
                                else if(data=='error-email') {
                                    alert("Votre email est incorrect !");
                                }
                            },
        
                            'text'
                        );


}
