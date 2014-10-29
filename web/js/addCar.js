/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var marqueWithModele = {};
$(document).ready(function(){
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
         
     $('#jc_joliecarbundle_voiture_modele_marque').change(function(){
       $('#jc_joliecarbundle_voiture_modele_nom>option').each(function(){
          $(this).attr('disabled','disabled');
       });
   }); 
    //stockage des marque et des modele qui lui liés
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
    $('#jc_joliecarbundle_voiture_modele_marque').change(function(){
        $('#jc_joliecarbundle_voiture_modele_nom>option:gt(0)').remove();
        $('#jc_joliecarbundle_voiture_modele_nom').select2("val","");
        marqueSelectionne = $('#jc_joliecarbundle_voiture_modele_marque>option:selected').text();
        for(var i=0;i<marqueWithModele[marqueSelectionne].length;i++)
        {           
            value = marqueWithModele[marqueSelectionne][i].split(";")[0];
            nomModele = marqueWithModele[marqueSelectionne][i].split(";")[1];
            $('#jc_joliecarbundle_voiture_modele_nom').append('<option value='+value+'>'+nomModele+'</option>');
        }
    });
    
    //****************ajout Marque*************/
    var displayMarque = true;
    $('#ajoutMarque').click(function(){
        var col = "col-lg-6 col-sm-6 col-md-6 col-xs-6";
        var colButton = "col-lg-2 col-sm-2 col-md-2 col-xs-2"; 
        var element = '<div id="newMarque"class="row" style="margin-top:40px;">';
            element = element + '<div class="'+col+'"><input type="text" placeholder="Saisissez la nouvel marque" name="nomMarque" class="form-control" "/> </div>'
            element = element + '<button id="btnAjoutMarque" class="'+colButton+'">Enregistrer</button>';
            element = element + '</div>'
            if(displayMarque){
                $("#nomMarque").append(element);
                $("#newMarque").hide();
                $("#newMarque").show('slow');
                displayMarque=false;
            }
            
    });
    displayModele=true;
    $('#ajoutModele').click(function(e){

               var col = "col-lg-6 col-sm-6 col-md-6 col-xs-6";
               var colButton = "col-lg-2 col-sm-2 col-md-2 col-xs-2"; 
               var element = '<div id="newModele" class="row" style="margin-top:40px;">';
                   element = element + '<div class="'+col+'"><input type="text"  placeholder="Saisissez le nouveau modele" name="nomModele" class="form-control" "/> </div>'
                   element = element + '<button id="btnAjoutModele" class="'+colButton+'">Enregistrer</button>';
                   element = element + '</div>';
                   if(displayMarque){
                        $("#nomModele").append(element);
                        $("#nomModele").hide();
                        $("#nomModele").show('slow');
                        displayModele=false;
                    }
    });
    
    $('#nomMarque').on('click', "button", function(e){
        e.preventDefault(); 
    });
    
    $("#nomModele").on('click',"button", function(e){
        e.preventDefault();
        $(this).tooltip({
           content : 'mlkjmk' 
        },"show");
    })
});