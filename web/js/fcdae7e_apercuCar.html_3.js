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
