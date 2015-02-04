/**
 * Created by Toure on 09/12/14.
 */


function displayCar($car){

}
function formaterPrix(value){
    return numeral(value).format().replace(/,/g,'.')+' GNF';
}
function addCar(car){
    var urlDetail = Routing.generate('joliecar_detail',{marque:car.modele.marque.id,modele:car.modele.id,id:car.id});
    var $container = $('#zoneApercu');
    //calcule de la position
    var nbreCar = $('#zoneApercu').children('.apercuCar').length;
    var widthCar = parseInt($('.apercuCar:first-child').width())+2*parseInt($('.apercuCar:first-child').css('margin-left'));
    var contenu = '<div class="apercuCar" style="position: absolute;left:'+widthCar+'">'+
        '<a href='+urlDetail+' class="thumbnail">';
    if(typeof car.main_image != "undefinded"){
        contenu += '<img src=/jolicar/web/'+car.main_image.webPath+car.main_image.path+' alt='+car.main_image.path+' class="img-rounded apercuCarImage"/>'
    }
    else{
        contenu +='<img src='+car.main_image.absolutePath+' alt="logo_joliecar" />'
    }
    contenu +='<div class="apercuCarInfo">'+
    '<div><h5 class="glyphicon glyphicon-wrench">'+ car.modele.marque.nom+'-'+car.modele.nom+'</h5></div>'+
    '<div><span class="glyphicon glyphicon-shopping-cart">'+formaterPrix(car.prix)+'</span></div>'+
    '</div>'+
    '</a>'+
    '</div>';
    $container.children('br').remove();
    $container.masonry()
        .append($(contenu))
        .masonry('addItems',$(contenu));
    $container.masonry('reloadItems');
    //$container.masonry('reloadItems')
    $container.append('<br clear="both">');

}
function infiniteScroll(url){

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
                    if(listeCar.length!=0){
                        for(var i=0;i<listeCar.length;i++){
                            addCar(listeCar[i]);
                        }
                        page +=1;
                    }
                    $('#loader').fadeOut(600);
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
}
function addMarqueAjax(e){
    e.preventDefault();
    newNomMarque = $('#newNomMarque').val();


    if(newNomMarque===""){
            displayMessage($('#message'),'Veuillez saisr la nouvelle marque','danger');
            return;
    }
    var test = existInSelect($('#jc_joliecarbundle_voiture_marque'),newNomMarque);
    if(test){
        displayMessage($('#message'),'Une marque de même nom existe déja','danger');
        return;
    }
   // var url = $('#ajoutMarque').data('url');
    var url = Routing.generate('add_marque',null,true);
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: {nom:newNomMarque}
    })
        .done(function(data,jqXHR){
            if (data.typeMessage=="success") {
                displayMessage($('#message'), data.message, data.typeMessage);
                var marque = $.parseJSON(data.marque);
                mesMarques.add(marque);
                addMarque($('#jc_joliecarbundle_voiture_marque'), marque['id'], marque['nom']);
                hideMarque();
            } else {
                var errors = $.parseJSON(data.message);
                for(var i=0;i<errors.length;i++){
                    displayMessage($('#message'),errors[i].message, data.typeMessage);
                }

            }

        })
        .fail(function(jqXHR){
            displayMessage($('#message'),jqXHR.responseText,'danger');
        })
    ;//fin ajax


}
function addModeleAjax(e){
    e.preventDefault();
    //*********** si la marque est selectionnee
    idMarque = $('#s2id_jc_joliecarbundle_voiture_marque').select2("val");
    if(idMarque === ""){
        displayMessage($('#message'),'Veuillez selectionner une marque','danger');
        return;
    }

    //******* si le modele est saisi ********
    newNomModele = $('#newNomModele').val();
    if(newNomModele === ""){
        displayMessage($('#message'),'Veuillez saisir le nouveau modele','danger');
        return;
    }
    if(existInSelect($('#jc_joliecarbundle_voiture_modele'),newNomModele)){
        displayMessage($('#message'),'un modele de même nom existe déja','danger');
        return;
    }
    var url = Routing.generate('add_modele',null,true);
    //var url = $('#ajoutModele').data('url');
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        data: {marque:idMarque,nom:newNomModele}
    })
        .done(function(data){
            if(data.typeMessage == "success"){
                displayMessage($('#message'),data.message,data.typeMessage);
                var newModele = $.parseJSON(data.newModele);
                mesModeles.add(newModele);
                //addModeleInMarque(newModele['marque'].nom,newModele['id'],newModele['nom']);
                loadModeleForMarque(newModele['marque'].nom);
                $('#jc_joliecarbundle_voiture_modele').select2("val",newModele['id']);
                hideModele();
            }
            else{
                var errors = $.parseJSON(data.message);
                for(var i=0;i<errors.length;i++){
                    displayMessage($('#message'),errors[i].message, data.typeMessage);
                }
            }

        })
        .fail(function(jqXHR,data){
            displayMessage($('#message'),data.message,'danger');
        })
    ;//fin ajax


}
function initMarque(){
    $('#jc_joliecarbundle_voiture_marque>option').each(function(){

        if($(this).text() !== ""){
            var marque = Object.create(Marque);
            marque.id = $(this).val();
            marque.nom = $(this).text();
            mesMarques.add(marque);
        }
    });
}
function initModele(){
    $('#jc_joliecarbundle_voiture_modele>option').each(function(){
        if($(this).text() !== ""){
            var marque = mesMarques.findByNom($(this).data('marque'));
            var modele = Object.create(Modele);
            modele.id = $(this).val();
            modele.nom = $(this).text();
            modele.marque = marque;

            mesModeles.add(modele);
        }
    });
}
function isInsertImage(numeroClick){
    if((numeroClick == mesImages.nextNumber-1) || (numeroClick == 0)){
        return true;
    }
    return false;
}
function getNumero(chaine,limite){
    var num = chaine.substr(limite);
    if(isNaN(parseInt(num)) ){
        return 0;
    }
    else{
        return num;
    }
}
function loadImage(parent,file,img,numeroClick,isRemove){
    var file = file.files[0];
    var reader = new FileReader();

    reader.onload = function(event){
        $(img).attr('src',event.target.result);
        //verifier s'il possede deja une croix de suppression
        var valId = 'removeImage_'+numeroClick;

        if(isRemove){
            $("<span id='"+valId+"'class='glyphicon glyphicon-remove'></span>").prependTo($(parent).find('.libelle'));
        }
        var image = Object.create(Image);
        image.numero = mesImages.nextNumber;
        image.src = $(img).attr('src');
        image.alt = $(img).attr('alt');
        //if(isInsertImage(numeroClick))
        if(!mesImages.exist(numeroClick)){
            mesImages.add(image);
            addUploadMiniature($('#images'),parseInt(numeroClick));
        }
        else{
            mesImages.update(image);
        }

    };
    if(file){
        reader.readAsDataURL(file);
    }else{
        $(img).attr('src',"/jolicar/web/images/specimenCar.png");
    }
}
function configSelect2(){
    $("#jc_joliecarbundle_voiture_marque").select2({
        //placeholder: 'Selectionner une marque',
        allowClear: true
    });
    $("#jc_joliecarbundle_voiture_modele").select2({
        //placeholder: 'Selectionner un modele',
        allowClear: true
    });

    $("#jc_joliecarbundle_voiture_boitier").select2({
        // placeholder: 'Selectionner le type de la boite à vitesse',
        allowClear: true
    });

    $("#jc_joliecarbundle_voiture_carburant").select2({
        // placeholder: 'Selectionner le type de carburant',
        allowClear: true
    });

    $("#jc_joliecarbundle_voiture_dateAcquisition_year").select2({
        // placeholder: 'Selectionner le type de carburant',
        allowClear: true
    });
    $("#jc_joliecarbundle_voiture_dateAcquisition_month").select2({
        // placeholder: 'Selectionner le type de carburant',
        allowClear: true
    });
    $("#jc_joliecarbundle_voiture_dateAcquisition_day").select2({
        // placeholder: 'Selectionner le type de carburant',
        allowClear: true
    });
}
function displayMessage(element,message,type) {   //****** Suppression des messages anterieurs *********
    $(element).children().fadeOut('fast');
    var button='<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>'
    $('<div class="alert alert-'+type+'" role="alert">'+button+'<strong>'+message+'</strong></div>').appendTo(element);
}
function showModele(){
    $('#ajoutModele').children("span").attr('class','glyphicon glyphicon-minus');
    var element = '<div id="newModele" class="ligneForm">';
    element = element + '<input type="text"  placeholder="Saisissez le nouveau modele" name="newNomModele" id="newNomModele" class="form-control" "/>'
    //element = element + '<button id="btnAjoutModele">Ajouter le modele</button>';
    element = element + '</div>';
    var btn = $('<button id="btnAjoutModele">Ajouter le modele</button>').click(function(e){
        addModeleAjax(e);
    });
    $(element).insertAfter('#nomModele');
    btn.appendTo('#newModele');
    //$("#nomModele").append(element);
    $("#newModele").hide();
    $("#newModele").show('slow');
}

function hideModele(){
    $('#ajoutModele').children("span").attr('class','glyphicon glyphicon-plus');
    $('#newModele').fadeOut('slow');
}
function showMarque(){
    $('#ajoutMarque').children("span").attr('class','glyphicon glyphicon-minus');
    var element = '<div id="newMarque" class="ligneForm">';
    element = element + '<input type="text" placeholder="Saisissez la nouvel marque" name="nom" id="newNomMarque" class="form-control" "/>'
    //element = element + '<button id="btnAjoutMarque">Ajouter la marque</button>';
    element = element + '</div>';
    var btn = $('<button id="btnAjoutMarque">Ajouter la marque</button>').click(function(e){
        addMarqueAjax(e);
    });
    $(element).insertBefore('#nomModele');
    btn.appendTo($('#newMarque'));
    //$("#nomMarque").append(element);
    $("#newMarque").hide();
    $("#newMarque").show('slow');

}
function hideMarque(){
    $('#ajoutMarque').children("span").attr('class','glyphicon glyphicon-plus');
    $('#newMarque').fadeOut('slow');
}


function loadMarque(listMarque){
    $('#jc_joliecarbundle_voiture_marque>option:gt(0)').remove();
    for(var i=0;i<listMarque.length;i++){

        $('#jc_joliecarbundle_voiture_marque').append('<option value="'+listMarque[i].id+'">'+listMarque[i].nom+'</option>');

    }
}
function addMarque(element,value,nom){
    $(element).append('<option value="'+value+'">'+nom+'</option>');
    $(element).select2("val",value);
    loadModeleForMarque(nom);
}

function loadModeleForMarque(marqueSelectionne){
    $('#jc_joliecarbundle_voiture_modele>option:gt(0)').remove();
    $('#jc_joliecarbundle_voiture_modele').select2("val","");
    var modeles = mesModeles.findByMarque(marqueSelectionne);
    for(var i=0;i<modeles.length;i++)
    {
        $('#jc_joliecarbundle_voiture_modele').append('<option value='+modeles[i].id+'>'+modeles[i].nom+'</option>');
    }
}

function existInSelect(select,value){
    var b=false;
    $(select).children('option').each(function(){
        if(value.toLowerCase() == $(this).text().toLowerCase()){
            b=true;
            return;
        }
    });
    return b;
}

function addUploadMiniature(parent,numeroClick){
    var prototype = $('#jc_joliecarbundle_voiture_images').data('prototype');
    var contenu = prototype.replace(/__name__/g,mesImages.nextNumber)
    var uploadMiniature= $(contenu);
    if(isInsertImage(numeroClick)){
        var br = $(parent).find('br');
        if(br.length){
            uploadMiniature.insertBefore($(br));
           // alert('bonjour');
        }
        else{
            uploadMiniature.appendTo($(parent));
        }
     //   $('#images').masonry('appended',uploadMiniature);
    }
}
function removeUploadMiniature(element){
    var position= getNumero($(element).attr('id'),16);
    var image = mesImages.findByNumero(position);
    $(element).remove();
    mesImages.remove(image);
    refreshNumber();
}

function refreshNumber(){
    $.each($('.libelle>em'), function (index,value) {
        $(value).text('Image '+(index+2));
    });
}

function attachInfobulle(element){
    $(element).mouseover(function(){
        var $this = $(this);

        if(typeof $this.data('infobulle')== "undefined") return false;

        $('body').append('<span class="infobulle"></span>');
        var bulle = $(".infobulle:last");
        bulle.append($this.data('infobulle'));
        var posTop = $this.offset().top - $this.height()*2;
        posTop<0?0:posTop+5;
        var posLeft = $this.offset().left;
        posLeft<0?0:posLeft+5;
        bulle.css({
            left:posLeft,
            top:posTop,
            opacity:0
        });

        bulle.animate({
            top:posTop,
            opacity:0.99
        });

    });

    $(element).mouseout(function(){

        var $this = $(this);
        if(typeof $this.data('infobulle')== "undefined") return false;
        var bulle = $(".infobulle:last");

        bulle.animate(
            {
                top: bulle.offset().top+10,
                opacity: 0
            },
            500,
            "linear",
            function(){
                bulle.remove();
            }
        );
    });
}