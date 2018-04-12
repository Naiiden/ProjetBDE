$(document).ready(function() {
    //Le code ici
    $(function() {
        //----- OPEN
        $('[data-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-open');
        $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
        e.preventDefault();
        });
        //----- CLOSE
        $('[data-popup-close]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('data-popup-close');
        $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
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
    });

    $( ".popup #button" ).click(function() {
        alert( "Handler for .click() called." );
    });

    $( "#sort1" ).click(function() {
        $('div.bloc-list-inner>div').each(function(){ 
            
            if(!$(this).hasClass("1")) {
                $(this).css({"display": "none"});
            }  else { $(this).css({"display": "block"}); }
        
        });

       
        $("#sortall").removeClass( "active" );
        $("#sort1").addClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").removeClass( "active" );

        $(this).addClass("active");
    });

    $( "#sort2" ).click(function() {
        $('div.bloc-list-inner>div').each(function(){ 
            
            if(!$(this).hasClass("2")) {
                $(this).css({"display": "none"});
            } else { $(this).css({"display": "block"}); }
        
        
        
        
        });
        
        $("#sortall").removeClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").addClass( "active" );
        $("#sort3").removeClass( "active" );
    });
    $( "#sort3" ).click(function() {
        $('div.bloc-list-inner>div').each(function(){ 
            
            if(!$(this).hasClass("3")) {
                $(this).css({"display": "none"});
            } else { $(this).css({"display": "block"}); }
        
        });
        
        $("#sortall").removeClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").addClass( "active" );
    });
    $( "#sortall" ).click(function() {
        $('div.bloc-list-inner>div').each(function(){ 
            
            
                $(this).css({"display": "block"});
        
        });
        
        $("#sortall").addClass( "active" );
        $("#sort1").removeClass( "active" );
        $("#sort2").removeClass( "active" );
        $("#sort3").removeClass( "active" );
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