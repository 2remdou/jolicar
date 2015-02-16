/**
 * Created by Toure on 11/01/15.
 */


$(document).ready(function(){
    loadIsActive=false;
    $('#jc_joliecarbundle_headerSearch_btnRechercher').click(function(e){
        e.preventDefault();
        var keySearch = $('#jc_joliecarbundle_headerSearch_rechercher').val();
        searchAjax(keySearch);
    });
    $('form[name="jc_joliecarbundle_headerSearch"]').submit(function(e){
        e.preventDefault();
        var keySearch = $('#jc_joliecarbundle_headerSearch_rechercher').val();
        searchAjax(keySearch);
    });
});