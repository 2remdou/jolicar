/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//var nombreImage = 0;


$(document).ready(function(){
    initMarque();
    initModele();
    $('#accordion').accordion({collapsible: true});
    configSelect2();
    //stockage des marques et des modeles qui lui liés

    $('#jc_joliecarbundle_voiture_marque').change(function(){
       marqueSelectionne = $('#jc_joliecarbundle_voiture_marque>option:selected').text();
       loadModeleForMarque(marqueSelectionne);
    });

    //****************ajout Marque*************/s
    $('#ajoutMarque').click(function(){
        
        
        var glyphicon = $(this).children("span").attr('class');
        
        if(glyphicon.indexOf("plus")!==-1){
            $('#newMarque').remove();
            showMarque();
        }            
        else{
            hideMarque();
        }
            
        
    });
    //************** ajout Modele ************
    $('#ajoutModele').click(function(){
        
        
        var glyphicon = $(this).children("span").attr('class');
        
        if(glyphicon.indexOf("plus")!==-1){           
            $('#newModele').remove();
            showModele();
        }            
        else{
            hideModele();
        }
               
    });
    
    $('#nomMarque').on('click', "button", function(e){
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
        
        
    });
    
    $("#nomModele").on('click',"button", function(e){
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
        
        
    })

    // for a main image
    $('#uploadMiniature_mainImage').on('change','input[type="file"]',function(){
        var parent = $('#uploadMiniature_mainImage');
        var file = document.querySelector('#uploadMiniature_mainImage input[type="file"]');
        var img = $('#uploadMiniature_mainImage img');
        var numeroClick = 0;
        loadImage(parent,file,img,numeroClick,false);
    });

    // for an others images
    $('#jc_joliecarbundle_voiture_images').on('change','input[type="file"]', function (){
       var parent = $(this).parent().parent().parent();
       var numeroClick = getNumero($(parent).attr('id'));
      //(uploadMiniature_)=16 caracteres
       var file = document.querySelector('#uploadMiniature_'+numeroClick+' input[type="file"]');
       var img = $('#uploadMiniature_'+numeroClick+' img');
       var isRemove = true;
        if($('#removeImage_'+numeroClick).length){
            isRemove = false;
        }
       loadImage(parent,file,img,numeroClick,isRemove);
        //nouvelle image,si c'est pas une modification d'une zone existante
           // addUploadMiniature($('#jc_joliecarbundle_voiture_images'),parseInt(numeroClick));

    });
    $('#jc_joliecarbundle_voiture_images').on('click','[id*="remove"]',function(){
        var numero = getNumero($(this).attr('id'));   //(remove_)= 6 caracteres
        var element = $(this).parent();
        removeUploadMiniature(element);
    })


});
/**
 * Created by Toure on 26/11/14.
 */

function getImages(){
    $('div[id*="uploadMiniature_"]').each(function(){
        imageSelect = $(this).children('img');
        image = Object.create(Image);
        var numero = getNumero($(this).attr('id'));
        console.log(numero);
        if(numero === 'mainImage'){
            numero = 0;
        }
        image.numero = numero;
        image.src = $(imageSelect).attr('src');
        image.alt = $(imageSelect).attr('alt');
        mesImages.add(image);
    });
}

$(document).ready(function(){
    getImages();

    $('#ajoutImage').click(function(e){
        e.preventDefault();
        //var file = document.querySelector('#uploadMiniature_'+lastNumber+' input[type="file"]');
        //var img = $('#uploadMiniature_'+lastNumber+' img');
        //nouvelle image,si c'est pas une modification d'une zone existante
        addUploadMiniature($('#jc_joliecarbundle_voiture_images'),mesImages.count()-1);
        $(this).remove();

    });

});
