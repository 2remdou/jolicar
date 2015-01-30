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
    sb.append("\/* \n * To change this license header, choose License Headers in Project Properties.\n * To change this template file, choose Tools | Templates\n * and open the template in the editor.\n *\/\nfunction infiniteScroll(){\n\n    \/\/ on initialise ajaxready \u00e0 true au premier chargement de la fonction\n    $(window).data('ajaxready', true);\n    var page=1;\n    var deviceAgent = navigator.userAgent.toLowerCase();\n    var agentID = deviceAgent.match(\/(iphone|ipod|ipad)\/);\n    var isLoad = true;\n    $(window).scroll(function() {\n        \/\/ On teste si ajaxready vaut false, auquel cas on stoppe la fonction\n       \/\/ if ($(window).data('ajaxready') == false) return;\n        if(!isLoad) return;\n        var url = Routing.generate('list_car',null,true);\n        if(($(window).scrollTop() + $(window).height()) == $(document).height()\n            || agentID && ($(window).scrollTop() + $(window).height()) + 150 > $(document).height()) {\n            \/\/ lorsqu'on commence un traitement, on met ajaxready \u00e0 false\n            \/\/$(window).data('ajaxready', false);\n            isLoad=false;\n            $('#loader').fadeIn(600);\n            $.ajax({\n                url: url,\n                datatype: \"json\",\n                type: \"GET\",\n                data: {page: page+1}\n            })\n                .done(function(data,jqXHR){\n                    var listeCar = $.parseJSON(data);\n                    console.log(listeCar);\n                    page +=1;\n                    $('#loader').fadeOut(600);\n                    console.log(\"page=\"+page);\n                    \/\/Twig.render(templateListeCar,{'listeCar': listeCar})\n                    \/\/$(window).data('ajaxready', true);\n                    isLoad=true;\n                })\n                .fail(function(jqXHR,data){\n                    displayMessage($('#message'),\"Ouups! quelque chose c'est mal pass\u00e9\",'danger')\n                })\n            ;\n            \/*$.get('\/more\/' + offset + '\/', function(data){\n                if (data != '') {\n                    $('#content #loader').before(data);\n                    $('#content .hidden').fadeIn(400);\n                    offset+= 20;\n                    \/\/ une fois tous les traitements effectu\u00e9s,\n                    \/\/ on remet ajaxready \u00e0 false\n                    \/\/ afin de pouvoir rappeler la fonction\n                    $(window).data('ajaxready', true);\n                }\n\n                $('#loader').fadeOut(400);\n            });*\/\n\n        }\n    });\n};\n $(document).ready(function() {\n     infiniteScroll();\n     function configSelect2() {\n         $(\"#jc_joliecarbundle_searchvoiture_modele_marque\").select2({\n             \/\/placeholder: 'Selectionner une marque',\n             allowClear: true\n         });\n         $(\"#jc_joliecarbundle_searchvoiture_modele_nom\").select2({\n             \/\/placeholder: 'Selectionner un modele',\n             allowClear: true\n         });\n         $(\"#jc_joliecarbundle_searchvoiture_boitier\").select2({\n             \/\/ placeholder: 'Selectionner le type de la boite \u00e0 vitesse',\n             allowClear: true\n         });\n\n         $(\"#jc_joliecarbundle_searchvoiture_carburant\").select2({\n             \/\/ placeholder: 'Selectionner le type de carburant',\n             allowClear: true\n         });\n\n         $('#jc_joliecarbundle_searchvoiture_modele_marque').change(function () {\n             $('#jc_joliecarbundle_searchvoiture_modele_nom>option').each(function () {\n                 $(this).attr('disabled', 'disabled');\n             });\n         });\n\n     }\n\n     $('#showSearch').click(function(){\n         $('#search').toggleClass(\"hideSearch\");\n     });\n\n     $(window).scroll(function(){\n         if($(window).scrollTop()==($(document).height-$(window).height())){\n             alert(\"fin\");\n         }\n     });\n     configSelect2();\n     \/*var url = Routing.generate('list_car',null,true);\n     $.ajax({\n         url : url,\n         type: 'GET',\n         datatype: 'json'\n     })\n         .done(function(data,jqXHR){\n\n         })\n         .fail(function(jqXHR,data){\n\n         })\n*\/\n     $('#zoneApercu').masonry({\n         itemSelector: '.apercuCar',\n         isFitWidth: false,\n         \"gutter\": 10\n     });\n });\n\n\n");
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

/**
 * @fileoverview Compiled template for file
 *
 * Resources/views/JolieCar/listeCar.html.twig
 *
 * @suppress {checkTypes|fileoverviewTags}
 */

goog.provide('templateListeCar');

goog.require('twig');
goog.require('twig.filter');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
templateListeCar = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(templateListeCar, twig.Template);

/**
 * @inheritDoc
 */
templateListeCar.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
templateListeCar.prototype.render_ = function(sb, context, blocks) {
    blocks = typeof(blocks) == "undefined" ? {} : blocks;
    // line 2
    sb.append("<div id=\"showSearch\" class=\"glyphicon glyphicon-search\" data-infobulle=\"Afficher les criteres de recherches\"><\/div>\n<br clear=\"both\">\n<div class=\"contour\">\n    <div id=\"zoneApercu\">\n        ");
    // line 6
    context['_parent'] = context;
    var seq = ("listeCar" in context ? context["listeCar"] : null);
    var loop = {
        'index0': 0,
        'index': 1,
        'first': true
    };
    if (twig.countable(seq)) {
        var length = twig.count(seq);
        loop['revindex0'] = length - 1;
        loop['revindex'] = length;
        loop['length'] = length;
        loop['last'] = 1 === length;
    }
    twig.forEach(seq, function(v, k) {
        context["_key"] = k;
        context["car"] = v;
        // line 7
        sb.append("            ");
        (new templateApercuCar(this.env_)).render_(sb, twig.extend({}, context, {"car": ("car" in context ? context["car"] : null)}));
        // line 8
        sb.append("        ");
        ++loop['index0'];
        ++loop['index'];
        loop['first'] = false;
        if (loop['length']) {
            --loop['revindex0'];
            --loop['revindex'];
            loop['last'] = 0 === loop['revindex0'];
        }
    }, this);
    // line 9
    sb.append("\n        <br clear=\"both\">\n    <\/div>\n    <div id=\"loader\" class=\"cacher\"><img src=\"");
    // line 12
    sb.append(twig.filter.escape(this.env_, this.env_.invoke("asset", "images\/jc_loader.gif"), "html", null, true));
    sb.append("\" alt=\"jc_loader\"\/><\/div>\n<\/div>\n");
};

/**
 * @inheritDoc
 */
templateListeCar.prototype.getTemplateName = function() {
    return "templateListeCar";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
templateListeCar.prototype.isTraitable = function() {
    return false;
};

/**
 * @fileoverview Compiled template for file
 *
 * Resources/views/JolieCar/apercuCar.html.twig
 *
 * @suppress {checkTypes|fileoverviewTags}
 */

goog.provide('templateApercuCar');

goog.require('twig');
goog.require('twig.filter');

/**
 * @constructor
 * @param {twig.Environment} env
 * @extends {twig.Template}
 */
templateApercuCar = function(env) {
    twig.Template.call(this, env);
};
twig.inherits(templateApercuCar, twig.Template);

/**
 * @inheritDoc
 */
templateApercuCar.prototype.getParent_ = function(context) {
    return false;
};

/**
 * @inheritDoc
 */
templateApercuCar.prototype.render_ = function(sb, context, blocks) {
    blocks = typeof(blocks) == "undefined" ? {} : blocks;
    // line 4
    sb.append("<div class=\"apercuCar\">\n    ");
    // line 5
    if (("car" in context ? context["car"] : null)) {
        // line 6
        sb.append("        <a href=\"");
        sb.append(twig.filter.escape(this.env_, this.env_.invoke("path", "joliecar_detail", {"marque": twig.attr(twig.attr(twig.attr(("car" in context ? context["car"] : null), "modele"), "marque"), "nom"), "modele": twig.attr(twig.attr(("car" in context ? context["car"] : null), "modele"), "nom"), "id": twig.attr(("car" in context ? context["car"] : null), "id")}), "html", null, true));
        sb.append("\" class=\"thumbnail\">\n                ");
        // line 7
        if (twig.attr(("car" in context ? context["car"] : null), "mainImage")) {
            // line 8
            sb.append("                    <img src=\"");
            sb.append(twig.filter.escape(this.env_, this.env_.invoke("asset", ((twig.attr(twig.attr(("car" in context ? context["car"] : null), "mainImage"), "webPath")) + (twig.attr(twig.attr(("car" in context ? context["car"] : null), "mainImage"), "path")))), "html", null, true));
            sb.append("\" alt=\"");
            sb.append(twig.filter.escape(this.env_, twig.attr(twig.attr(("car" in context ? context["car"] : null), "mainImage"), "path"), "html", null, true));
            sb.append("\" class=\"img-rounded apercuCarImage\"\/>\n                ");
        } else {
            // line 10
            sb.append("                    <img src=\"");
            sb.append(twig.filter.escape(this.env_, this.env_.invoke("asset", "images\/logo_joliecar.jpg"), "html", null, true));
            sb.append("\" alt=\"logo_joliecar\" \/>\n                ");
        }
        // line 12
        sb.append("\n                <div class=\"apercuCarInfo\">\n                       <div><h5 class=\"glyphicon glyphicon-wrench\"> ");
        // line 14
        sb.append(twig.filter.escape(this.env_, twig.attr(twig.attr(twig.attr(("car" in context ? context["car"] : null), "modele"), "marque"), "nom"), "html", null, true));
        sb.append("-");
        sb.append(twig.filter.escape(this.env_, twig.attr(twig.attr(("car" in context ? context["car"] : null), "modele"), "nom"), "html", null, true));
        sb.append("<\/h5><\/div>\n                       <div><span class=\"glyphicon glyphicon-shopping-cart\"> ");
        // line 15
        sb.append(twig.filter.escape(this.env_, this.env_.filter("formaterPrix", twig.attr(("car" in context ? context["car"] : null), "prix")), "html", null, true));
        sb.append("<\/span><\/div>\n                <\/div>\n         <\/a>\n    ");
    }
    // line 19
    sb.append("<\/div>    \n    \n    \n");
};

/**
 * @inheritDoc
 */
templateApercuCar.prototype.getTemplateName = function() {
    return "templateApercuCar";
};

/**
 * Returns whether this template can be used as trait.
 *
 * @return {boolean}
 */
templateApercuCar.prototype.isTraitable = function() {
    return false;
};
