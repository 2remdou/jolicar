<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 16/11/14
 * Time: 23:00
 */

namespace Jc\JolieCarBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Doctrine\ORM\EntityManager;

class ListeModele extends  LazyChoiceList {

    protected $listeModele;
    protected $listeMarque;
    public function __construct(EntityManager $em){
        $this->listeModele = $em->getRepository("JcJolieCarBundle:Modele")->findAll();
    }
    protected  function loadChoicelist(){
        $listeNom = array();
        //creation d'un tableau de la 'idModele' => 'nomModele'
        foreach($this->listeModele as $modele){
            $listeNom[$modele->getId()] = $modele->getNom();
        }
        return new SimpleChoiceList($listeNom);
    }
}