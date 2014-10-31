/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var marqueWithModele = {};

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
function displayMessage(element,message,type)
{   //****** Suppression des messages anterieurs *********
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
                    marqueWithModele[nomMarque].push($(this).attr('value')+';'+nomModele);
                    $(this).remove();
                }
            });

        }

    });
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

$(document).ready(function(){
    
      configSelect2();
      liaisonMarqueModele();
    //stockage des marque et des modele qui lui liés
    
    $('#jc_joliecarbundle_voiture_modele_marque').change(function(){
       marqueSelectionne = $('#jc_joliecarbundle_voiture_modele_marque>option:selected').text();
       loadModeleForMarque(marqueSelectionne);
    });
    
    //****************ajout Marque*************/
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
        var url = $('#ajoutMarque').data('url');
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: {nom:newNomMarque}
        })
                .done(function(data,jqXHR){               
                    displayMessage($('#message'),data.message,'success');
                    hideAjoutMarque();
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
        
        var url = $('#ajoutModele').data('url');
        $.ajax({
            url: url,
            type: "POST",
            data: {marque:idMarque,nom:newNomModele}
        })
                .done(function(data){               
                    displayMessage($('#message'),data,'success');
                    hideAjoutModele();
                })
                .fail(function(jqXHR){
                    displayMessage($('#message'),jqXHR.responseText,'danger');        
                })
        ;//fin ajax
        
        
    })
});