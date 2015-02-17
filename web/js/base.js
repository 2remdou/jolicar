/**
 * Created by Toure on 02/01/15.
 */
$(document).ready(function(){

    $('#menu').click(function(){
        $('#profil').toggleClass("hideProfil");
    });
    $('.nomMarque').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var keySearch = $this.text();
        searchAjax(keySearch);
    });
    attachInfobulle($('[class*="glyphicon"]'));
    $('.glyphicon-chevron-down').click(function(e){
        $this = $(this);
        var marque = $this.parent().children('a').text();
        $('[data-modele='+marque+']').toggleClass('cacher');
        //$this.parent().parent().children('<a>').toggleClass('cacher');
    });
});
