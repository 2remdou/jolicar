<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadImageData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 7;
    }

    public function load(ObjectManager $manager) {

        for($i=1;$i<=8;$i++)
        {
            for($j=1;$j<=3;$j++)
            {
                $images[$j] = new Image();
                
                $voiture = $this->getReference('voiture'.($i-1));
                $images[$j]->setPath($i.'_'.$j.'.jpg');
                $images[$j]->setNom($i.'_'.$j.'.jpg');
                //$images[$j]->setFile(new UploadedFile(__DIR__.'/../../../../../web/images/cars/4_1.jpg',"2_2.jpg"));
                $images[$j]->setVoiture($voiture);
                if($j==1){
                    $images[$j]->setMainImage(true);
                    $voiture->setMainImage($images[$j]);

                }
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

