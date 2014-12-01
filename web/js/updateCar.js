/**
 * Created by Toure on 26/11/14.
 */

$(document).ready(function(){

    $('#ajoutImage').click(function(e){
        e.preventDefault();
        lastImage = $('#jc_joliecarbundle_voiture_images div[id*="uploadMiniature_"]').last();
        var lastNumber = $(lastImage).attr('id').substr(16);//(uploadMiniature_)=16 caracteres
        var file = document.querySelector('#uploadMiniature_'+lastNumber+' input[type="file"]');
        var img = $('#uploadMiniature_'+lastNumber+' img');
        //nouvelle image,si c'est pas une modification d'une zone existante
        addUploadMiniature($('#jc_joliecarbundle_voiture_images'),parseInt(lastNumber));
        $(this).remove();

    });

});
