/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var marqueWithModele = {};
$(document).ready(function(){
    //stockage des marque et des modele qui lui liés
    $('#jc_joliecarbundle_searchvoiture_modele_marque>option').each(function(){
        
       var nomMarque=$(this).text();
        if(nomMarque !== "")
        {
            marqueWithModele[nomMarque] = [];
            $('#jc_joliecarbundle_searchvoiture_modele_nom>option').each(function(){
                var nomModele = $(this).text();
                
                if($(this).data('marque')===nomMarque)
                {
                    marqueWithModele[nomMarque].push($(this).attr('value')+';'+nomModele);
                    $(this).remove();
                }
            });

        }

    });
    $('#jc_joliecarbundle_searchvoiture_modele_marque').change(function(){
        $('#jc_joliecarbundle_searchvoiture_modele_nom>option:gt(0)').remove();
        $('#jc_joliecarbundle_searchvoiture_modele_nom').select2("val","");
        marqueSelectionne = $('#jc_joliecarbundle_searchvoiture_modele_marque>option:selected').text();
        for(var i=0;i<marqueWithModele[marqueSelectionne].length;i++)
        {           
            value = marqueWithModele[marqueSelectionne][i].split(";")[0];
            nomModele = marqueWithModele[marqueSelectionne][i].split(";")[1];
            $('#jc_joliecarbundle_searchvoiture_modele_nom').append('<option value='+value+'>'+nomModele+'</option>');
        }
    });
});