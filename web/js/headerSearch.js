/**
 * Created by Toure on 11/01/15.
 */

function searchAjax(){
    loadIsActive = false;
    var $this = $(this);
    var $main = $('#main')
    $main.children().remove();
    var loader = '<div id="loaderListe"><img src="/jolicar/web/images/jc_loader.gif" alt="jc_loader"/></div>';
    $main.append(loader);
    var url = Routing.generate('jc_short_search',null,true);
    var keySearch = $('#jc_joliecarbundle_headerSearch_rechercher').val();

    $.ajax({
        url: url,
        datatype: "json",
        type: "POST",
        data: {query:keySearch}
    })
        .done(function(data){
            $main.prepend('<div class="contour"><div id="zoneApercu"></div></div>')
            done(data);
            $('#loaderListe').remove();
        })
        .fail(function(jqXHR,data){
            fail(jqXHR,data);
        })
}
function done(data){
    var resultat = $.parseJSON(data);
    resultat = resultat._results;
    if(typeof resultat == "undefined" || resultat.length==0){
        displayMessage($('.contour'),"Aucun resultat pour votre recherche",'info')
        return;
    }
    for(var i=0;i<resultat.length;i++){
        var car = resultat[i]._hit._source;
        addCar(car);
    }
}
function fail(jqXHR,data){

}
$(document).ready(function(){
    loadIsActive=false;
    $('#jc_joliecarbundle_headerSearch_btnRechercher').click(function(e){
        e.preventDefault();
        searchAjax();
    });
    $('form[name="jc_joliecarbundle_headerSearch"]').submit(function(e){
        e.preventDefault();
        searchAjax();
    });
});