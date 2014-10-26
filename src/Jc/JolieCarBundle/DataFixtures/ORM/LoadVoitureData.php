<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadVoitureData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Voiture;

class LoadVoitureData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 6;
        
    }

    public function load(ObjectManager $manager) {
        $listeInfo = array(
            array('kmParcouru' => 1700,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 3000000,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-08-15',
                  'newCar' => true),
             array('kmParcouru' => 8800,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 9900000,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-08-15',
                  'newCar' => true),
             array('kmParcouru' => 88900,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 556700000,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2018-08-15'),
             array('kmParcouru' => 345600,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 2,
                  'prix' => 7526728972,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2012-08-15',
                  'newCar' => true),
            array('kmParcouru' => 1700,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 87272,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-08-11'),
             array('kmParcouru' => 8800,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 256789,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-08-09',
                  'newCar' => true),
             array('kmParcouru' => 88900,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 4,
                  'prix' => 788908906,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-02-15'),
             array('kmParcouru' => 2245600,
                  'nombrePorte'=> 4,
                  'nombreSiege'=> 2,
                  'prix' => 99850000,
                  'nombreRoueMotrice' => 4,
                  'dateAcquistion' => '2014-08-15',
                  'newCar' => true)
        );
        foreach ($listeInfo as $i => $info) {
            $voitures[$i] = new Voiture();
            $voitures[$i]->setKmParcouru($info['kmParcouru']);
            $voitures[$i]->setNombrePorte($info['nombrePorte']);
            $voitures[$i]->setNombreSiege($info['nombreSiege']);
            $voitures[$i]->setPrix($info['prix']);
            $voitures[$i]->setNombreRoueMotrice($info['nombreRoueMotrice']);
            $voitures[$i]->setDateAcquisition(new \DateTime($info['dateAcquistion']));
            if(array_key_exists('newCar',$info))
            {
                $voitures[$i]->setNewCar($info['newCar']);
            }
            $boitier = $this->getReference('boitier'.rand(0, count($manager->getRepository("JcJolieCarBundle:Boitier")->findAll())-1));
            $voitures[$i]->setBoitier($boitier);
            
            $carburant = $this->getReference('carburant'.rand(0, count($manager->getRepository("JcJolieCarBundle:Carburant")->findAll())-1));
            $voitures[$i]->setCarburant($carburant);
            
            $parc = $this->getReference('parc'.rand(0, count($manager->getRepository("JcJolieCarBundle:Parc")->findAll())-1));
            $voitures[$i]->setParc($parc);
            
            $modele = $this->getReference('modele'.rand(0, count($manager->getRepository("JcJolieCarBundle:Modele")->findAll())-1));
            $voitures[$i]->setModele($modele);
  
            $manager->persist($voitures[$i]);
            $this->addReference('voiture'.$i, $voitures[$i]);
        }
        
        $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

