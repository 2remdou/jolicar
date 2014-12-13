/**
 * Created by Toure on 09/12/14.
 */
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
function getNumero(id){
    return id.substr(16);
}
function loadImage(parent,file,img,numeroClick,isRemove){
    var file = file.files[0];
    var reader = new FileReader();

    reader.onload = function(event){
        $(img).attr('src',event.target.result);
        //verifier s'il possede deja une croix de suppression
        var valId = 'removeImage_'+numeroClick;

        if(isRemove){
            $("<span id='"+valId+"'class='glyphicon glyphicon-remove'></span>").prependTo($(parent));
        }
        var image = Object.create(Image);
        image.numero = mesImages.nextNumber;
        image.src = $(img).attr('src');
        image.alt = $(img).attr('alt');
        //if(isInsertImage(numeroClick))
        if(!mesImages.exist(numeroClick)){
            mesImages.add(image);
            addUploadMiniature($('#jc_joliecarbundle_voiture_images'),parseInt(numeroClick));
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
    var col = "col-lg-6 col-sm-6 col-md-6 col-xs-6";
    var colButton = "col-lg-2 col-sm-2 col-md-2 col-xs-2";
    var element = '<div id="newModele" class="row" style="margin-top:40px;">';
    element = element + '<div class="'+col+'"><input type="text"  placeholder="Saisissez le nouveau modele" name="newNomModele" id="newNomModele" class="form-control" "/> </div>'
    element = element + '<button id="btnAjoutModele" class="'+colButton+'">Enregistrer</button>';
    element = element + '</div>';
    $("#nomModele").append(element);
    $("#newModele").hide();
    $("#newModele").show('slow');
}

function hideModele(){
    $('#ajoutModele').children("span").attr('class','glyphicon glyphicon-plus');
    $('#newModele').fadeOut('slow');
}
function showMarque(){
    $('#ajoutMarque').children("span").attr('class','glyphicon glyphicon-minus');
    var col = "col-lg-6 col-sm-6 col-md-6 col-xs-6";
    var colButton = "col-lg-2 col-sm-2 col-md-2 col-xs-2";
    var element = '<div id="newMarque"class="row" style="margin-top:40px;">';
    element = element + '<div class="'+col+'"><input type="text" placeholder="Saisissez la nouvel marque" name="nom" id="newNomMarque" class="form-control" "/> </div>'
    element = element + '<button id="btnAjoutMarque" class="'+colButton+'">Enregistrer</button>';
    element = element + '</div>'
    $("#nomMarque").append(element);
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
    prototype = $(parent).data('prototype');

    var contenu =  "<div id='uploadMiniature_"+mesImages.nextNumber+"' class='col-lg-2 col-md-3 col-sm-3 col-xs-4 thumbnail'> " +
        "<div class='libelleImage text-center'></div>" +
        "<img src='/jolicar/web/images/specimenCar.png' alt='logo_joliecar' class='img-responsive'/> " +
        "<div class='fileinput-button text-center'> <div class='btn-success'> <i class='glyphicon glyphicon-upload'></i>Ajoutez image </div> ";
    if(typeof prototype != "undefined"){
        contenu = contenu + prototype.replace(/__name__/g,mesImages.nextNumber)
    }
    contenu = contenu +
    "</div> " +
    "</div>";
    var uploadMiniature= $(contenu);
    if(isInsertImage(numeroClick)){
        uploadMiniature.appendTo($(parent));
        refreshNumber();
    }
}
function removeUploadMiniature(element){
    var position= getNumero($(element).attr('id'));
    var image = mesImages.findByNumero(position);
    $(element).remove();
    mesImages.remove(image);
    refreshNumber();
}

function refreshNumber(){
    $.each($('.libelleImage'), function (index,value) {
        $(value).text('Image '+(index+2));
    });
}