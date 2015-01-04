/**
 * Created by Toure on 26/11/14.
 */

function getImages(){
    $('[id*="uploadMiniature_"]').each(function(){
        var $this = $(this);
        var imageSelect = $($this).find('img');
        var fileSelect = $($this).find('input[type="file"]');
        var image = Object.create(Image);
        var numero = $(fileSelect).data('numero');

        image.numero = numero;
        image.src = $(imageSelect).attr('src');
        image.alt = $(imageSelect).attr('alt');
        mesImages.add(image);
    });
}

function moveImage(){
    $('#jc_joliecarbundle_voiture_images>[id*="uploadMiniature_"]').each(function(){
      var $this = $(this);
        $($this).insertBefore($('#images>br'));
    });
}

$(document).ready(function(){
    moveImage();
    getImages();

    $('#ajoutImage').click(function(e){
        var $this =  $(this);
        e.preventDefault();
        $this.trigger('mouseout');
        //var file = document.querySelector('#uploadMiniature_'+lastNumber+' input[type="file"]');
        //var img = $('#uploadMiniature_'+lastNumber+' img');
        //nouvelle image,si c'est pas une modification d'une zone existante
        addUploadMiniature($('#images'),mesImages.count()-1);
        //$('#images>br').insertAfter($('#images>div:last-child'));
        $(this).remove();

    });

});
