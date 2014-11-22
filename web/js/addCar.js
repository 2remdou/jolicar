/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var marqueWithModele = {};
var nombreImage = 0;
function loadImage(parent,file,img,numero){
    var file = file.files[0];
    var reader = new FileReader();

    reader.onload = function(event){
        $(img).attr('src',event.target.result);
        $("<span id='removeImage_'"+nombreImage+"' class='glyphicon glyphicon-remove'></span>").prependTo($(parent));
    };
    if(file){
        reader.readAsDataURL(file);
    }else{
        $(img).attr('src',"/jolicar/web/images/specimenCar.png");
    }
}
function configSelect2(){
     $("#jc_joliecarbundle_voiture_modele_marque").select2({
         //placeholder: 'Selectionner une marque', 
         allowClear: true
         }); 
     $("#jc_joliecarbundle_voiture_modele_nom").select2({
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
function showAjoutModele(){
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
        
function hideAjoutModele(){
            $('#ajoutModele').children("span").attr('class','glyphicon glyphicon-plus');
            $('#newModele').fadeOut('slow');
        }
function showAjoutMarque(){
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
function hideAjoutMarque(){
            $('#ajoutMarque').children("span").attr('class','glyphicon glyphicon-plus');
            $('#newMarque').fadeOut('slow');
        }

function addModeleInMarque(marque,valueModele,modele){
    marqueWithModele[marque].push(valueModele+';'+modele);
}
function liaisonMarqueModele(){
        $('#jc_joliecarbundle_voiture_modele_marque>option').each(function(){
        
        var nomMarque=$(this).text();
        if(nomMarque !== "")
        {
            marqueWithModele[nomMarque] = [];
            $('#jc_joliecarbundle_voiture_modele_nom>option').each(function(){
                var nomModele = $(this).text();
                
                if($(this).data('marque')===nomMarque)
                {
                    addModeleInMarque(nomMarque,$(this).attr('value'),nomModele)
                    $(this).remove();
                }
            });

        }

    });
}

function loadMarque(listMarque){
    $('#jc_joliecarbundle_voiture_modele_marque>option:gt(0)').remove();
    for(var i=0;i<listMarque.length;i++){

            $('#jc_joliecarbundle_voiture_modele_marque').append('<option value="'+listMarque[i].id+'">'+listMarque[i].nom+'</option>');

    }
}
function addMarque(element,value,nom){
    $(element).append('<option value="'+value+'">'+nom+'</option>');
    $(element).select2("val",value);
}

function loadModeleForMarque(marqueSelectionne){
     $('#jc_joliecarbundle_voiture_modele_nom>option:gt(0)').remove();
        $('#jc_joliecarbundle_voiture_modele_nom').select2("val","");      
        for(var i=0;i<marqueWithModele[marqueSelectionne].length;i++)
        {           
            value = marqueWithModele[marqueSelectionne][i].split(";")[0];
            nomModele = marqueWithModele[marqueSelectionne][i].split(";")[1];
            $('#jc_joliecarbundle_voiture_modele_nom').append('<option value='+value+'>'+nomModele+'</option>');
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
$(document).ready(function(){
    $('#accordion').accordion({collapsible: true});
      configSelect2();
      liaisonMarqueModele();
    //stockage des marque et des modele qui lui liés

    $('#jc_joliecarbundle_voiture_modele_marque').change(function(){
       marqueSelectionne = $('#jc_joliecarbundle_voiture_modele_marque>option:selected').text();
       loadModeleForMarque(marqueSelectionne);
    });

    //****************ajout Marque*************/s
    $('#ajoutMarque').click(function(){
        
        
        var glyphicon = $(this).children("span").attr('class');
        
        if(glyphicon.indexOf("plus")!==-1){
            $('#newMarque').remove();
            showAjoutMarque();
        }            
        else{
            hideAjoutMarque();
        }
            
        
    });
    //************** ajout Modele ************
    $('#ajoutModele').click(function(){
        
        
        var glyphicon = $(this).children("span").attr('class');
        
        if(glyphicon.indexOf("plus")!==-1){           
            $('#newModele').remove();
            showAjoutModele();
        }            
        else{
            hideAjoutModele();
        }
               
    });
    
    $('#nomMarque').on('click', "button", function(e){
        e.preventDefault(); 
        newNomMarque = $('#newNomMarque').val();
        

        if(newNomMarque===""){
            displayMessage($('#message'),'Veuillez saisr la nouvelle marque','danger');
            return;
        }
        var test = existInSelect($('#jc_joliecarbundle_voiture_modele_marque'),newNomMarque);
        if(test){
            displayMessage($('#message'),'Une marque de même nom existe déja','danger');
            return;
        }
        var url = $('#ajoutMarque').data('url');
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {nom:newNomMarque}
        })
                .done(function(data,jqXHR){
                if (data.typeMessage=="success") {
                    displayMessage($('#message'), data.message, data.typeMessage);
                    marqueWithModele[newNomMarque] = [];
                    var marque = $.parseJSON(data.marque);
                    addMarque($('#jc_joliecarbundle_voiture_modele_marque'), marque['id'], marque['nom']);
                    hideAjoutMarque();
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
        
        
    });
    
    $("#nomModele").on('click',"button", function(e){
        e.preventDefault();
        //*********** si la marque est selectionnee
        idMarque = $('#s2id_jc_joliecarbundle_voiture_modele_marque').select2("val");
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
        if(existInSelect($('#jc_joliecarbundle_voiture_modele_nom'),newNomModele)){
            displayMessage($('#message'),'un modele de même nom existe déja','danger');
            return;
        }

        var url = $('#ajoutModele').data('url');
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
                        addModeleInMarque(newModele['marque'].nom,newModele['id'],newModele['nom']);
                        loadModeleForMarque(newModele['marque'].nom);
                        $('#s2id_jc_joliecarbundle_voiture_modele_nom').select2("val",newModele['id']);
                        hideAjoutModele();
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
        
        
    })

    function addUploadMiniature(parent,numeroClick){
        var prototype = $(parent).data('prototype');
        //var nombreImage = parent.children('[id*="uploadMiniature"]').length;
        var libelleImage;
        var contenu = "";
        if(nombreImage==0){
            libelleImage="Image Principale";
        }
        else{
            libelleImage="Image "+(nombreImage+1);
        }
        contenu =  "<div id='uploadMiniature_"+nombreImage+"' class='col-lg-2 col-md-3 col-sm-3 col-xs-4 thumbnail'> " +
        "<div class='libelleImage text-center'>"+libelleImage+"</div>" +
        "<img src='/jolicar/web/images/specimenCar.png' alt='logo_joliecar' class='img-responsive'/> " +
        "<div class='fileinput-button text-center'> <div class='btn-success'> <i class='glyphicon glyphicon-upload'></i>Ajoutez image </div> " +
        prototype.replace(/__name__/g,nombreImage)+
        "</div> " +
        "</div>";
       var uploadMiniature= $(contenu);
        if((nombreImage <= numeroClick+1) || (nombreImage==0)){
            uploadMiniature.appendTo($(parent));
            nombreImage++;

        }

    }

    function removeUploadMiniature(element){
        $(element).remove();
    }
    addUploadMiniature($('#jc_joliecarbundle_voiture_images'));
    $('#jc_joliecarbundle_voiture_images').on('change','input[type="file"]', function (){
       var parent = $(this).parent().parent().parent();
       var numeroClick = $(parent).attr('id').substr(16);//(uploadMiniature_)=16 caracteres
       var file = document.querySelector('#uploadMiniature_'+numeroClick+' input[type="file"]');
       var img = $('#uploadMiniature_'+numeroClick+' img');
       loadImage(parent,file,img,numeroClick);

        //nouvelle image,si c'est pas une modification d'une zone existante
            addUploadMiniature($('#jc_joliecarbundle_voiture_images'),parseInt(numeroClick));

    });
    $('#jc_joliecarbundle_voiture_images').on('click','[id*="remove"]',function(){
        var numero = $(this).attr('id').substr(6);    //(remove_)= 6 caracteres
        var element = $(this).parent();
        removeUploadMiniature(element);
    })


});