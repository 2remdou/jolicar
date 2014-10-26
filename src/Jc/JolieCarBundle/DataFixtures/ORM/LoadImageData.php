<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadImageData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Image;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 7;
    }

    public function load(ObjectManager $manager) {
        $nbreVoiture=count($manager->getRepository("JcJolieCarBundle:Boitier")->findAll());
        
        for($i=1;$i<=8;$i++)
        {
            for($j=1;$j<=3;$j++)
            {
                $images[$j] = new Image();
                
                $voiture = $this->getReference('voiture'.($i-1));
                $j==1 ? $images[$j]->setEnVedette(true): $images[$j]->setEnVedette(false) ;
                $images[$j]->setNom($i.'_'.$j.'.jpg');
                $images[$j]->setVoiture($voiture);
                $manager->persist($images[$j]);
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

