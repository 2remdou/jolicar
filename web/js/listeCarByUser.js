/**
 * Created by Toure on 01/02/15.
 */
$(document).ready(function(){
    var path = $(location).attr('href').split('/');
    var infoUser = path[path.length-1].split('-');
    var user = infoUser[0];
    var userId = infoUser[1];
    var url = Routing.generate('list_car_by_user',{user:user,id:userId},true);
    infiniteScroll(url);
});
