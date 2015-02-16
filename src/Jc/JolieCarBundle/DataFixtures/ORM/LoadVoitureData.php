<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadVoitureData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Image;
use Jc\JolieCarBundle\Entity\Voiture;
use Symfony\Component\HttpFoundation\File\File;

class LoadVoitureData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 7;
        
    }

    public function load(ObjectManager $manager) {
        $listeImage = array(
            '00b13b09a2d7f9308b6c87fe54d88c8b43d3bc4c.jpeg',
            '02d6c598bf443133ebfe8230592cd816bd375b7c.jpeg',
            '1049082ccf699f61ef2e607debc5717da5ee14fc.jpeg',
            '1aaa1b0153d0413d6c3b08f587838d33041033a6.jpeg',
            '1d0eeeb5f89163821137b6c9bbb73c91f06ac5e3.jpeg',
            '40e5186c5affa8cbec47b94183c4a3be41fb3f19.jpeg',
            '5bf35545d99dd307187ec8aeea07ba327a4cd678.jpeg',
            '6c6e1fcb1d0a56e7b9d479d691b171f1f6aacf65.jpeg',
            '6c6e1fcb1d0a56e7b9d479d691b171f1f6aacf652.jpeg',
            '83da2cff37f6806083f218676610ead990bc5751.jpeg',
            '92750ec8026c4b36f15e61a1e4e9cae4bb25bdff.jpeg',
            '9cd9d07d01b174092c2e1ea25be0ba88b56e6cca.jpeg',
            'b15672bf83611643530cc6b21baf536f7c3fcf04.jpeg',
            'b41e896949a5ed110b49e00cb976f3dff6da90a5.jpeg'
        );
        $imageDirectory = __DIR__.'/../../../../../web/images/fixtures/';
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
            $image = new Image();
            $image->setFile(new File($imageDirectory.$listeImage[$i]));
            $voitures[$i]->setMainImage($image);
            if(array_key_exists('newCar',$info))
            {
                $voitures[$i]->setNewCar($info['newCar']);
            }
            $boitier = $this->getReference('boitier'.rand(0, count($manager->getRepository("JcJolieCarBundle:Boitier")->findAll())-1));
            $voitures[$i]->setBoitier($boitier);
            
            $carburant = $this->getReference('carburant'.rand(0, count($manager->getRepository("JcJolieCarBundle:Carburant")->findAll())-1));
            $voitures[$i]->setCarburant($carburant);
            
            $user = $this->getReference('user'.rand(0, count($manager->getRepository("JcUserBundle:User")->findAll())-1));
            $voitures[$i]->setUser($user);
            
            $modele = $this->getReference('modele'.rand(0, count($manager->getRepository("JcJolieCarBundle:Modele")->findAll())-1));
            $voitures[$i]->setModele($modele);


            $manager->persist($voitures[$i]);
            $this->addReference('voiture'.$i, $voitures[$i]);
        }
        
        $manager->flush();
    }

}


