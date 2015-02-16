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
        $this.parent().parent().find('.modeles').toggleClass('cacher');
    });
});
