<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadCarburantData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Carburant;

class LoadCarburantData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder() {
        return 3;
    }

    public function load(ObjectManager $manager) {
        
        $listeCarburant = array('Essence', 'Diesel');
        
        foreach ($listeCarburant as $i => $carburant) {
            $carburants[$i] = new Carburant();
            $carburants[$i]->setNom($carburant);
            
            $manager->persist($carburants[$i]);
            $this->addReference('carburant'.$i, $carburants[$i]);
        }
        
        $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

