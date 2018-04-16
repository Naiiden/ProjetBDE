var photo = 0;

function getDate() {
    var d = new Date();

var month = d.getMonth()+1;
var day = d.getDate();
var heure = d.getHours();
var minute = d.getMinutes();
var seconde = d.getSeconds();

var output = d.getFullYear() + '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') + day + " " + heure+":"+minute+":"+seconde ;
    return output;
}

$(document).ready(function() {
    //Le code ici
    $(function() {
        //----- OPEN
        $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
        $('html').addClass('popup-open');
        e.preventDefault();

        });
        //----- CLOSE
        $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
        $(".comments-popup").children().remove();
        $('html').removeClass('popup-open');
        e.preventDefault();
        });

        $('.validate').on('click', function(e)  {
           // $(".name-idea").text($(this).attr('validate')); 


            $.post('getIdea.php', 
            {
                idIdea: $(this).attr('validate'),
                action: 'get-idea'
            },
            
            function(data) {
                if(data!='Echec') {
                    var tab=data.split("|");

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

        $('.photo').on('click', function(e)  {
            $.post('getCommentsLikes.php', 
            {
                photoId: $(this).attr('photo'),
                userId: $(this).attr('user')
            },
            
            function(data) {
                if(data!='Echec') {
                    var json = JSON.parse(data);
                    $("#image-popup").attr("src","img/local/event_photo/"+json['photo']);

                   var commentaires = json['commentaires'].split('|');
                   var commentairesId = json['commentairesId'].split('|');
                   var reports = json['reports'].split('|');
                   var noms = json['noms'].split('|');
                   var photoId = json['photoId'];
                   
                   var dates =json['dates'].split('|');
                    
                var i = 0;

                if(noms[0]!="") {

                 noms.forEach(function() {
                    afficherCommentaires(noms[i],dates[i],commentaires[i], commentairesId[i], reports[i]);
                    i = i + 1;
                  });
                }
                else {
                    $("<h2 style='color:rgb(99, 0, 0);'>Il n'y a encore aucun commentaire !</h2>").appendTo('.comments-popup');
                }

                  photo=photoId;

                      

                    


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


   
    $( ".popup #button" ).click(function() {
        alert( "Handler for .click() called." );
    });



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
})

function openPhoto() {
    alert("open");
}

function sendIdea() {
    if($(".idea-name").val() != "") {
        if($(".idea-message").val() != "") {
            if($(".idea-postal").val() != "")  {

                $.post('sendIdea.php', 
                            {
                                name: $(".idea-name").val(),
                                message: $(".idea-message").val(),
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
            } else alert("Veuillez renseigner un code postal !");
        } else alert("Veuillez renseigner un message !");
    } else alert("Veuillez renseigner un nom !");
}

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


function reportComment(commentIdForm) {
   $.post('reportComment.php', 
                            {
                                commentId: commentIdForm,
                                action: "reportComment"
                            },
                            
                            function(data) {
                                if(data=='Succes') {
                                    $("#"+commentIdForm).css("background-color","#ff8080");
                                    $('.report-comment-'+commentIdForm).html('Les membre du CESI ont été informés !')
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

function participeEvent() {
    alert("heello");
}

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