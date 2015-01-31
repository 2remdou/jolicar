/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function addCar(car){
    var urlDetail = Routing.generate('joliecar_detail',{marque:car.modele.marque.id,modele:car.modele.id,id:car.id});
    var zone = $('#zoneApercu');
    var contenu = '<div class="apercuCar">'+
        '<a href='+urlDetail+' class="thumbnail">';
                if(typeof car.main_image != "undefinded"){
                    contenu += '<img src='+car.main_image.webPath+car.main_image.path+' alt='+car.main_image.path+' class="img-rounded apercuCarImage"/>'
                }
                else{
                    contenu +='<img src='+car.webPath+car.path+' alt="logo_joliecar" />'
                }
            contenu +='<div class="apercuCarInfo">'+
                '<div><h5 class="glyphicon glyphicon-wrench">'+ car.modele.marque.nom+'-'+car.modele.nom+'</h5></div>'+
                '<div><span class="glyphicon glyphicon-shopping-cart">'+ car.prix+'</span></div>'+
            '</div>'+
        '</a>'+
    '</div>';

    $(contenu).insertBefore($(zone).children('br'));
    $('#zoneApercu').masonry('appended', $(contenu));

}
function infiniteScroll(){

    // on initialise ajaxready à true au premier chargement de la fonction
    $(window).data('ajaxready', true);
    var page=1;
    var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);
    var isLoad = true;
    $(window).scroll(function() {
        // On teste si ajaxready vaut false, auquel cas on stoppe la fonction
       // if ($(window).data('ajaxready') == false) return;
        if(!isLoad) return;
        var url = Routing.generate('list_car',null,true);
        if(($(window).scrollTop() + $(window).height()) == $(document).height()
            || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()) {
            // lorsqu'on commence un traitement, on met ajaxready à false
            //$(window).data('ajaxready', false);
            isLoad=false;
            $('#loader').fadeIn(600);
            $.ajax({
                url: url,
                datatype: "json",
                type: "GET",
                data: {page: page+1}
            })
                .done(function(data,jqXHR){
                    var listeCar = $.parseJSON(data);
                    console.log(listeCar);
                    for(var i=0;i<listeCar.length;i++){
                        addCar(listeCar[i]);
                    }

                    page +=1;
                    $('#loader').fadeOut(600);
                    console.log("page="+page);
                    //Twig.render(templateListeCar,{'listeCar': listeCar})
                    //$(window).data('ajaxready', true);
                    isLoad=true;
                })
                .fail(function(jqXHR,data){
                    displayMessage($('#message'),"Ouups! quelque chose c'est mal passé",'danger')
                })
            ;
            /*$.get('/more/' + offset + '/', function(data){
                if (data != '') {
                    $('#content #loader').before(data);
                    $('#content .hidden').fadeIn(400);
                    offset+= 20;
                    // une fois tous les traitements effectués,
                    // on remet ajaxready à false
                    // afin de pouvoir rappeler la fonction
                    $(window).data('ajaxready', true);
                }

                $('#loader').fadeOut(400);
            });*/

        }
    });
};
 $(document).ready(function() {
     infiniteScroll();
     function configSelect2() {
         $("#jc_joliecarbundle_searchvoiture_modele_marque").select2({
             //placeholder: 'Selectionner une marque',
             allowClear: true
         });
         $("#jc_joliecarbundle_searchvoiture_modele_nom").select2({
             //placeholder: 'Selectionner un modele',
             allowClear: true
         });
         $("#jc_joliecarbundle_searchvoiture_boitier").select2({
             // placeholder: 'Selectionner le type de la boite à vitesse',
             allowClear: true
         });

         $("#jc_joliecarbundle_searchvoiture_carburant").select2({
             // placeholder: 'Selectionner le type de carburant',
             allowClear: true
         });

         $('#jc_joliecarbundle_searchvoiture_modele_marque').change(function () {
             $('#jc_joliecarbundle_searchvoiture_modele_nom>option').each(function () {
                 $(this).attr('disabled', 'disabled');
             });
         });

     }

     $('#showSearch').click(function(){
         $('#search').toggleClass("hideSearch");
     });

     $(window).scroll(function(){
         if($(window).scrollTop()==($(document).height-$(window).height())){
             alert("fin");
         }
     });
     configSelect2();
     /*var url = Routing.generate('list_car',null,true);
     $.ajax({
         url : url,
         type: 'GET',
         datatype: 'json'
     })
         .done(function(data,jqXHR){

         })
         .fail(function(jqXHR,data){

         })
*/
     $('#zoneApercu').masonry({
         itemSelector: '.apercuCar',
         isFitWidth: false,
         "gutter": 10
     });
 });


