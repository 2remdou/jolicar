<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadMarqueData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Boitier;

class LoadBoitierData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 4;   
    }

    public function load(ObjectManager $manager) {
        $listeBoitier = array('Automatique','Manuel');
        
        foreach ($listeBoitier as $i => $boitier) {
            $boitiers[$i] = new Boitier();
            $boitiers[$i]->setNom($boitier);
            $manager->persist($boitiers[$i]);
            $this->addReference('boitier'.$i, $boitiers[$i]);
        }
        
        $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

