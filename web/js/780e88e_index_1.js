/**
 * @fileoverview Compiled template for file
 *
 * js/index.js
 *
 * @suppress {checkTypes|fileoverviewTags}
 */

goog.provide('index.js');

goog.require('twig');
goog.require('twig.filter');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
index.js = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(index.js, twig.Template);

/**
 * @inheritDoc
 */
index.js.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
index.js.prototype.render_ = function(sb, context, blocks) {
    blocks = typeof(blocks) == "undefined" ? {} : blocks;
    // line 1
    sb.append("\/* \n * To change this license header, choose License Headers in Project Properties.\n * To change this template file, choose Tools | Templates\n * and open the template in the editor.\n *\/\nfunction addCar(car){\n    var urlDetail = Routing.generate('joliecar_detail',{marque:car.modele.marque.id,modele:car.modele.id,id:car.id});\n    var zone = $('#zoneApercu');\n    var contenu = '<div class=\"apercuCar\">'+\n        '<a href='+urlDetail+' class=\"thumbnail\">';\n                if(typeof car.main_image != \"undefinded\"){\n                    contenu += '<img src='+car.main_image.webPath+car.main_image.path+' alt='+car.main_image.path+' class=\"img-rounded apercuCarImage\"\/>'\n                }\n                else{\n                    contenu +='<img src='+car.webPath+car.path+' alt=\"logo_joliecar\" \/>'\n                }\n            contenu +='<div class=\"apercuCarInfo\">'+\n                '<div><h5 class=\"glyphicon glyphicon-wrench\">'+ car.modele.marque.nom+'-'+car.modele.nom+'<\/h5><\/div>'+\n                '<div><span class=\"glyphicon glyphicon-shopping-cart\">'+ car.prix+'<\/span><\/div>'+\n            '<\/div>'+\n        '<\/a>'+\n    '<\/div>';\n\n    $(contenu).insertBefore($(zone).children('br'));\n    $('#zoneApercu').masonry('appended', $(contenu));\n\n}\nfunction infiniteScroll(){\n\n    \/\/ on initialise ajaxready \u00e0 true au premier chargement de la fonction\n    $(window).data('ajaxready', true);\n    var page=1;\n    var deviceAgent = navigator.userAgent.toLowerCase();\n    var agentID = deviceAgent.match(\/(iphone|ipod|ipad)\/);\n    var isLoad = true;\n    $(window).scroll(function() {\n        \/\/ On teste si ajaxready vaut false, auquel cas on stoppe la fonction\n       \/\/ if ($(window).data('ajaxready') == false) return;\n        if(!isLoad) return;\n        var url = Routing.generate('list_car',null,true);\n        if(($(window).scrollTop() + $(window).height()) == $(document).height()\n            || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()) {\n            \/\/ lorsqu'on commence un traitement, on met ajaxready \u00e0 false\n            \/\/$(window).data('ajaxready', false);\n            isLoad=false;\n            $('#loader').fadeIn(600);\n            $.ajax({\n                url: url,\n                datatype: \"json\",\n                type: \"GET\",\n                data: {page: page+1}\n            })\n                .done(function(data,jqXHR){\n                    var listeCar = $.parseJSON(data);\n                    console.log(listeCar);\n                    for(var i=0;i<listeCar.length;i++){\n                        addCar(listeCar[i]);\n                    }\n\n                    page +=1;\n                    $('#loader').fadeOut(600);\n                    console.log(\"page=\"+page);\n                    \/\/Twig.render(templateListeCar,{'listeCar': listeCar})\n                    \/\/$(window).data('ajaxready', true);\n                    isLoad=true;\n                })\n                .fail(function(jqXHR,data){\n                    displayMessage($('#message'),\"Ouups! quelque chose c'est mal pass\u00e9\",'danger')\n                })\n            ;\n            \/*$.get('\/more\/' + offset + '\/', function(data){\n                if (data != '') {\n                    $('#content #loader').before(data);\n                    $('#content .hidden').fadeIn(400);\n                    offset+= 20;\n                    \/\/ une fois tous les traitements effectu\u00e9s,\n                    \/\/ on remet ajaxready \u00e0 false\n                    \/\/ afin de pouvoir rappeler la fonction\n                    $(window).data('ajaxready', true);\n                }\n\n                $('#loader').fadeOut(400);\n            });*\/\n\n        }\n    });\n};\n $(document).ready(function() {\n     infiniteScroll();\n     function configSelect2() {\n         $(\"#jc_joliecarbundle_searchvoiture_modele_marque\").select2({\n             \/\/placeholder: 'Selectionner une marque',\n             allowClear: true\n         });\n         $(\"#jc_joliecarbundle_searchvoiture_modele_nom\").select2({\n             \/\/placeholder: 'Selectionner un modele',\n             allowClear: true\n         });\n         $(\"#jc_joliecarbundle_searchvoiture_boitier\").select2({\n             \/\/ placeholder: 'Selectionner le type de la boite \u00e0 vitesse',\n             allowClear: true\n         });\n\n         $(\"#jc_joliecarbundle_searchvoiture_carburant\").select2({\n             \/\/ placeholder: 'Selectionner le type de carburant',\n             allowClear: true\n         });\n\n         $('#jc_joliecarbundle_searchvoiture_modele_marque').change(function () {\n             $('#jc_joliecarbundle_searchvoiture_modele_nom>option').each(function () {\n                 $(this).attr('disabled', 'disabled');\n             });\n         });\n\n     }\n\n     $('#showSearch').click(function(){\n         $('#search').toggleClass(\"hideSearch\");\n     });\n\n     $(window).scroll(function(){\n         if($(window).scrollTop()==($(document).height-$(window).height())){\n             alert(\"fin\");\n         }\n     });\n     configSelect2();\n     \/*var url = Routing.generate('list_car',null,true);\n     $.ajax({\n         url : url,\n         type: 'GET',\n         datatype: 'json'\n     })\n         .done(function(data,jqXHR){\n\n         })\n         .fail(function(jqXHR,data){\n\n         })\n*\/\n     $('#zoneApercu').masonry({\n         itemSelector: '.apercuCar',\n         isFitWidth: false,\n         \"gutter\": 10\n     });\n });\n\n\n");
};

/**
 * @inheritDoc
 */
index.js.prototype.getTemplateName = function() {
    return "index.js";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
index.js.prototype.isTraitable = function() {
    return true;
};
