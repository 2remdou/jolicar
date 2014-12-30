<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadAdresseData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Adresse;

class LoadAdresseData extends AbstractFixture implements OrderedFixtureInterface
{
    public function getOrder() {
        return 5;
    }

    public function load(ObjectManager $manager) {
        $listeAdresses = Array(
            array('telephone' => '666332244',
                 'email' => 'aaaaa@gmail.com',
                 'site' => 'www.aaaa.com',
                 'ville' => 'Conakry',
                 'quartier' => 'yimbaya',
                 'indicationLieu' => 'a cote de moi'),
            array('telephone' => '666879654',
                 'email' => 'bbbbb@yahoo.com',
                 'site' => 'www.bbbbb.com',
                 'ville' => 'Conakry',
                 'quartier' => 'ratoma',
                 'indicationLieu' => 'a cote de toi'),
            array('telephone' => '666889944',
                 'email' => 'ccccc@gmail.com',
                 'site' => 'www.cccccc.com',
                 'ville' => 'kindia',
                 'quartier' => 'almamya',
                 'indicationLieu' => 'a cote de lui')
        );
        foreach ($listeAdresses as $i => $element) {
                $adresses[$i] = new Adresse();
                $adresses[$i]->setIndicationLieu($element['indicationLieu']);
                $adresses[$i]->setQuartier($element['quartier']);
                $adresses[$i]->setSite($element['site']);
                $adresses[$i]->setTelephone($element['telephone']);
                $adresses[$i]->setVille($element['ville']);
                
                $manager->persist($adresses[$i]);
                $this->addReference('adresse'.$i, $adresses[$i]);
            
        }
        $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

