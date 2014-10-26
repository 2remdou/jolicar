/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function(){
    //*********ajuster imageTop au contenu**************$*
    $(".imageTop>img").width($(".imageTop").parent().width());
    $(".miniatures").width($(".imageTop").parent().width());
    //***********changer imageTop en fonction du survol****
    $(".miniature").mouseover(function(){
        var src=$(this).attr('src');
        var alt=$(this).attr('alt');
       $(".imageTop>img").attr('src',src); 
       $(".imageTop>img").attr('alt',alt);
    });
    
    $(window).resize(function(){
        $(".imageTop>img").width($(".imageTop").parent().width());
        $(".miniatures").width($(".imageTop").parent().width());
    });
});