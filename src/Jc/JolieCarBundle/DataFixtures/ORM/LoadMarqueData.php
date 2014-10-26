<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadMarqueData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Marque;
use Jc\JolieCarBundle\Entity\Modele;

class LoadMarqueData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 3;
    }

    public function load(ObjectManager $manager) {
        $listeMarque = array(
            'Mercedes' => array('170','180'),
            'Renaults' => array('Clio','Espace'),
            'Peugeot'  => array('104','106'),
            'Opel'     => array('Astra','Combo'),
            );
        $k=0;
        foreach ($listeMarque as $i => $element) {
            $marques[$i] = new Marque();
            $marques[$i]->setNom($i);
            $manager->persist($marques[$i]);
            
            foreach ($element as $value) {
                $modele = new Modele();
                $modele->setNom($value);
                $modele->setMarque($marques[$i]);
                $manager->persist($modele);
                $this->addReference('modele'.$k, $modele);
                $k++;
            }
   
        }
        
        $manager->flush();
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

