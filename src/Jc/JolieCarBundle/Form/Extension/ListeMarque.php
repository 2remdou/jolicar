<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 16/11/14
 * Time: 23:00
 */

namespace Jc\JolieCarBundle\Form\Extension;

use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\LazyChoiceList;
use Doctrine\ORM\EntityManager;

class ListeMarque extends  LazyChoiceList {

    protected $listeModele;
    public function __construct(EntityManager $em){
        $this->listeModele = $em->getRepository("JcJolieCarBundle:Marque")->findAll();
    }
    protected  function loadChoicelist(){
        $listeNom = array();
        //creation d'un tableau de la 'idModele' => 'nomModele'
        foreach($this->listeModele as $marque){
            $listeNom[$marque->getId()] = $marque->getNom();
        }
       return new SimpleChoiceList($listeNom);
    }
}