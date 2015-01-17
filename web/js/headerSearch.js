/**
 * Created by Toure on 11/01/15.
 */

function done(data){
    console.log(data);
}
function fail(jqXHR,data){

}
$(document).ready(function(){
    $('#jc_joliecarbundle_headerSearch_btnRechercher').click(function(e){
        e.preventDefault();
        var $this = $(this);
        //var url = $this.data('url');
        var url = Routing.generate('jc_search',null,true);
        alert(url);
        var keySearch = $('#jc_joliecarbundle_headerSearch_rechercher').val();

        $.ajax({
            url: url,
            datatype: "json",
            type: "POST",
            data: {query:keySearch}
        })
            .done(function(data){
                done(data);
            })
            .fail(function(jqXHR,data){
                fail(jqXHR,data);
            })
    });
});