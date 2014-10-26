/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 $(document).ready(function() { 
     //definition des select2
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
         
     $('#jc_joliecarbundle_searchvoiture_modele_marque').change(function(){
       $('#jc_joliecarbundle_searchvoiture_modele_nom>option').each(function(){
          $(this).attr('disabled','disabled');
       });
   }); 
     
 });


