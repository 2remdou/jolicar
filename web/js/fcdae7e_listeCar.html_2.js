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
