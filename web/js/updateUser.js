/**
 * Created by Toure on 08/01/15.
 */
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
        var url = $this.data('url');

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
                data = $.parseJSON(data);
                displayMessage($('#messageInfoGeneral'),data.message,'danger');
            })
        ;

    });
    $('#btnPassword').click(function(e){
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
        var url = $this.data('url');

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
            .fail(function(jqXHR){
                displayMessage($('#messageInfoGeneral'),data.message,'danger');
            });
    });
    $('#btnAdresse').click(function(e){
        var $this = $(this);
        e.preventDefault();

        var url = $this.data('url');
    });
});