/**
 * Created by mdoutoure on 16/12/2014.
 */

function adopteLibelle(typeUser){
    if(typeUser === 'Parc'){
        $('label[for="fos_user_registration_form_nom"]').text("Nom du parc");
        $("#fos_user_registration_form_nom").attr("placeholder",'Veuillez fournir votre nom du parc');
        $('label[for="fos_user_registration_form_autreNom"]').fadeOut('fast');
        $("#fos_user_registration_form_autreNom").fadeOut('fast');

    }
    else{
        console.log($(this).attr('placeholder'));
        $('label[for="fos_user_registration_form_autreNom"]').fadeIn('fast');
        $("#fos_user_registration_form_autreNom").fadeIn('fast');
        $('label[for="fos_user_registration_form_nom"]').text("Nom");
        $("#fos_user_registration_form_nom").attr("placeholder",'Veuillez fournir votre nom');
        $('label[for="fos_user_registration_form_autreNom"]').text("Prenom");
        $("#fos_user_registration_form_autreNom").attr("placeholder",'Veuillez fournir votre prenom');
    }
}
$(document).ready(function(){
    $('#accordion').accordion({collapsible: true});
    $("#fos_user_registration_form_typeUser").on('click','[id*="fos_user_registration_form_typeUser_"]',function(){
        var id=$(this).attr('id');
        adopteLibelle($('label[for='+id+']').text());
    });
});