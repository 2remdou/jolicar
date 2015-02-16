/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//var nombreImage = 0;


$(document).ready(function(){
    initMarque();
    initModele();
    $('#jc_joliecarbundle_voiture_dateAcquisition').datepicker({
        changeMonth: true,
        changeYear : true,
        dateFormat: "dd/mm/yy"
    });
    $('#accordion').accordion({collapsible: true});
    configSelect2();
    Math.random()

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
    

    $("#nomModele").on('click',"button", function(e){

    })

    $('#images').on('change','input[type="file"]', function (){
        var $this = $(this);
        var numeroClick = $this.data('numero');
        if(numeroClick==-1){
            var parent = $('#uploadMiniature_mainImage');
            var idFile = 'jc_joliecarbundle_voiture_mainImage_file';
            var isRemove = false;
        }
        else{
            var parent = $('#uploadMiniature_'+numeroClick);
            var idFile = 'jc_joliecarbundle_voiture_images_'+numeroClick+'_file';
            var isRemove = true
        }
       var file = document.querySelector('#'+idFile);
       var img = $(parent).find('img');

       loadImage(parent,file,img,numeroClick,isRemove);

    });

    $('#images').on('click','[id*="remove"]',function(){
        var numero = getNumero($(this).attr('id'),12);   //(remove_)= 6 caracteres
        if(numero==-1){
            var element = $('#uploadMiniature_mainImage');
        }
        else{
            var element = $('#uploadMiniature_'+numero);
        }
        removeUploadMiniature(element);
    })


});