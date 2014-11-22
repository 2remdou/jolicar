<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Jc\JolieCarBundle\Twig;

class JolieCarExtension extends \Twig_Extension
{
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('formaterPrix', array($this,'formaterPrix')),
            new \Twig_SimpleFilter('typeAlert', array($this,'typeAlert')),
        );
    }
    public function getFunctions(){
        return array(
          new \Twig_SimpleFunction('controlNull', array($this,'controlNull')),
        );
    }
    
    public function formaterPrix($value=null,$devise=null)
    {
        if($devise === null)
        {
            $devise = 'GNF';
        }
        
        if($value === null)
        {
            $value = 0;
        }
        
        $prix = number_format($value, 0, '.','.');
        
        return $prix.' '.$devise;
    }
    public function typeAlert($value){
        if(preg_match("/echec|erreur/i",$value)){
            return 'danger';
        }
        else
        {
            return 'success';
        }
    }
    public function controlNull($value){
        if($value == null){
        return "";
        }
        return $value;
    }

    public function getName() {
        return 'joliecar_extension';
    }

}
