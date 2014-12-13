<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadParcData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Proprietaire;

class LoadProprietaireData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 5;
    }

    public function load(ObjectManager $manager) {
       $listeProprietaire = array('Toure et frere','AutoFaste','ParcFamilly');
       $nbreAdresse=0;
       foreach ($listeProprietaire as $i => $proprietaire) {
           $proprietaires[$i] = new Proprietaire();
           $proprietaires[$i]->setNom($proprietaire);
           $proprietaires[$i]->setAdresse($this->getReference('adresse'.$nbreAdresse));
           $manager->persist($proprietaires[$i]);
           $nbreAdresse == count($manager->getRepository("JcJolieCarBundle:Adresse")->findAll())? $nbreAdresse=0 : $nbreAdresse++;
       
           $this->addReference('proprietaire'.$i, $proprietaires[$i]);
       }
       
       $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

