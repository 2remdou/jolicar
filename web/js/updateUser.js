/**
 * Created by Toure on 08/01/15.
 */

function done(ForShowMessage,data,jqXHR){
    data = $.parseJSON(data);
    if (data.typeMessage=="success") {
        displayMessage($(ForShowMessage), data.message, data.typeMessage);
    } else {
            displayMessage($(ForShowMessage),data.message, data.typeMessage);
    }
}
function fail(ForShowMessage,jqXHR,data){
    displayMessage($(ForShowMessage),data.message,'danger');
}
$(document).ready(function(){
    $('#btnInfo').click(function(e){
        var $this = $(this);
        e.preventDefault();
        var nom = $('#fos_user_registration_form_nom').val();
        var autreNom = $('#fos_user_registration_form_autreNom').val();
        var email = $('#fos_user_registration_form_email').val();
        var typeUser = $('input[type="radio"][name="fos_user_registration_form[typeUser]"]:checked').attr('value');
        if(nom==""){
            displayMessage($('#messageInfoGeneral'),'Veuillez fournir un nom','danger');
            return;
        }
        if(email ==""){
            displayMessage($('#messageInfoGeneral'),'Veuillez fournir une adresse email','danger');
            return;
        }

        if(typeof typeUser == "undefined"){
            displayMessage($('#messageInfoGeneral'),'Veuillez selectionner le type d\'utilisateur','danger');
            return;
        }
        var data = {nom : nom, autreNom: autreNom, email: email, typeUser: typeUser};
       // var url = $this.data('url');
        var url = Routing.generate('update_info_user',null,true);

        $.ajax({
            url: url,
            type: "POST",
            datatype: "json",
            data: data
        })
            .done(function(data,jqXHR){
                data = $.parseJSON(data);
                if (data.typeMessage=="success") {
                    displayMessage($('#messageInfoGeneral'), data.message, data.typeMessage);
                } else {
                    var errors = $.parseJSON(data.message);
                    for(var i=0;i<errors.length;i++){
                        displayMessage($('#messageInfoGeneral'),errors[i].message, data.typeMessage);
                    }

                }
            })
            .fail(function(jqXHR,data){
                displayMessage($('#message'),data.message,'danger');
            })
        ;

    });
    $('#btnAdresse').click(function(e){
        var $this = $(this);
        e.preventDefault();
        var telephone = $('#fos_user_registration_form_adresse_telephone').val();
        var site = $('#fos_user_registration_form_adresse_site').val();
        var ville = $('#fos_user_registration_form_adresse_ville').val();
        var quartier = $('#fos_user_registration_form_adresse_quartier').val();
        var indicationLieu = $('#fos_user_registration_form_adresse_indicationLieu').val();

        var data = {
            telephone : telephone,
            site: site,
            ville: ville,
            quartier: quartier,
            indicationLieu: indicationLieu

        };
        //var url = $this.data('url');
        var url = Routing.generate('update_adresse',null,true);
        $.ajax({
            url: url,
            type: "POST",
            datatype: "json",
            data: data
        })
            .done(function(data,jqXHR){
                data = $.parseJSON(data);
                if (data.typeMessage=="success") {
                    displayMessage($('#messageAdresse'), data.message, data.typeMessage);
                } else {
                    var errors = $.parseJSON(data.message);
                    for(var i=0;i<errors.length;i++){
                        displayMessage($('#messageAdresse'),errors[i].message, data.typeMessage);
                    }

                }
            })
            .fail(function(jqXHR){
                displayMessage($('#messageAdresse'),data.message,'danger');
            });
    });
    $('#btnPassword').click(function(e){
        var $this = $(this);
        e.preventDefault();

        //var url = $this.data('url');
        var url = Routing.generate('update_password',null,true);

        var password1 = $('#fos_user_registration_form_plainPassword_first').val();
        var password2 = $('#fos_user_registration_form_plainPassword_second').val();
        if( password1.length ==0 || password1 !== password2){
            displayMessage($('#messageInfoGeneral'),'Les mots de passe ne sont pas identiques','danger');
            return;
        }
        var data = {password1:password1,password2:password2};

        $.ajax({
            url : url,
            type: "POST",
            data : data,
            datatype : "json"
        })
            .done(function(data,jqXHR){
                done($('#messageInfoGeneral'),data,jqXHR);
            })
            .fail(function(jqXHR,data){
                fail($('#messageInfoGeneral'),jqXHR,data)
            })
        ;
    });
});