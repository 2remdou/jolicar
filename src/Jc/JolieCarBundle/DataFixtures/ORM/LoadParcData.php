<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadParcData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Parc;

class LoadParcData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 5;
    }

    public function load(ObjectManager $manager) {
       $listeParc = array('Toure et frere','AutoFaste','ParcFamilly');
       $nbreAdresse=0;
       foreach ($listeParc as $i => $parc) {
           $parcs[$i] = new Parc();
           $parcs[$i]->setNom($parc);
           $parcs[$i]->setAdresse($this->getReference('adresse'.$nbreAdresse));
           $manager->persist($parcs[$i]);
           $nbreAdresse== count($manager->getRepository("JcJolieCarBundle:Adresse")->findAll())? $nbreAdresse=0 : $nbreAdresse++;
       
           $this->addReference('parc'.$i, $parcs[$i]);
       }
       
       $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

