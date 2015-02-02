/**
 * Created by Toure on 01/02/15.
 */
$(document).ready(function(){
    var url = Routing.generate('list_car',null,true);
    infiniteScroll(url);
});