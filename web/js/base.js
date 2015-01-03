/**
 * Created by Toure on 02/01/15.
 */
$(document).ready(function(){

    $('#menu').click(function(){
        $('#profil').toggleClass("hideProfil");
    });

    attachInfobulle($('[class*="glyphicon"]'));
});
