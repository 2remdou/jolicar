/**
 * Created by Toure on 07/12/14.
 */
if (typeof Object.create != 'function') {
    Object.create = (function() {
        var Object = function() {};
        return function (prototype) {
            if (arguments.length > 1) {
                throw Error('Second argument not supported');
            }
            if (typeof prototype != 'object') {
                throw TypeError('Argument must be an object');
            }
            Object.prototype = prototype;
            var result = new Object();
            Object.prototype = null;
            return result;
        };
    })();
}

var Marque = {
    id : 0,
    nom : 'unknown'
}

var Modele = {
    id : 0,
    nom : 'unknown',
    marque : Object.create(Marque)
}

var Page = {
    numero : '0',
    contenu : ''
}
var listePage = {
    pages : [],

    add : function(page){
        this.pages.push(page);
    },

    list : function(){
        return this.pages;
    },

    findByNumero : function(numero){
        for(var i=0;i<this.pages.length;i++){
            if(this.pages[i].numero == numero){
                return this.pages[i];
            }
        }
        return false;
    },

    count: function(){
        return this.pages.length;
    }

}
var listeMarque = {
    marques : [],

    add : function(marque){
        this.marques.push(marque);
    },

    list : function(){
        return this.marques;
    },

    findById : function(id){
      for(var i=0;i<this.marques.length;i++){
          if(this.marques[i].id == id){
              return this.marques[i];
          }
      }
        return null;
    },

    findByNom: function(nom){
        for(var i=0;i<this.marques.length;i++){
            if(this.marques[i].nom == nom){
                return this.marques[i];
            }
        }
        return null;
    }
}

var listeModele = {
    modeles : new Array(),

    add : function(Modele){
       this.modeles.push(Modele);
    },
    list : function(){
        return this.modeles;
    },

    findById : function(id){
        for(var i=0;i<this.modeles.length;i++){
            if(this.modeles[i].id == id){
                return this.modeles[i];
            }
        }
        return null;
    },

    findByNom: function(nom){
        for(var i=0;i<this.modeles.length;i++){
            if(this.modeles[i].nom == nom){
                return this.modeles[i];
            }
        }
        return null;
    },

    findByMarque: function(nomMarque){
        var modeles = new Array();
        for(var i=0;i<this.count();i++){
            if(this.modeles[i].marque.nom == nomMarque){
                modeles.push(this.modeles[i]);
            }
        }
        return modeles;
    },

    count: function(){
        return this.modeles.length;
    }
}

var image = {
    src : '/jolicar/web/images/logo_joliecar.jpg',
    alt : 'joliecar',
    numero : null
}
var listeImage = {
    images : [],
    nextNumber : 0,
    add : function(image){
        this.images.push(image);
        this.nextNumber += 1;
    },

    update : function(image){
        var position = this.findIndex(image);
        if(position != null){
            this.images[position].src = image.src;
            this.images[position].alt = image.alt;
        }
    },

    list : function(){
        return this.images;
    },

    findByNumero : function(numero){
        for(var i=0;i<this.images.length;i++){
            if(this.images[i].numero == numero){
                return this.images[i];
            }
        }
        return null;
    },
    findIndex : function(image){
        for(var i=0;i<this.images.length;i++){
            if(this.images[i].numero == image.numero){
                return i;
            }
        }
        return null;
    },

    remove : function(image){
        var position = this.findIndex(image);
        this.images.splice(position,1);
    },

    count: function (){
        return this.images.length;
    },

    exist: function(numero){
        for(var i=0;i<this.images.length;i++){
            if(this.images[i].numero == numero){
                return true;
            }
        }
        return false;
    }
}
var mesMarques = Object.create(listeMarque);
var mesModeles = Object.create(listeModele);
var mesImages = Object.create(listeImage);
var mesPages = Object.create(listePage);