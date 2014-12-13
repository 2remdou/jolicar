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
