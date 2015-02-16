<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadImageData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\JolieCarBundle\Entity\Image;
use Jc\JolieCarBundle\Form\ImageType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LoadImageData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 8;
    }

    public function load(ObjectManager $manager) {
        //for i in `ls *.jpeg`; do echo "'$i',"; done
        $listeImage = array(
            'b9ec901052b2639037d6457dfcfd7c7f4919bab8.jpeg',
            'd6975bf1eb061bc2618a2ee1c572e18a790f3dbd.jpeg',
            'de7ddec4f2ec30ccdb5b93f7ae94e9f7bb290523.jpeg',
            'de7ddec4f2ec30ccdb5b93f7ae94e9f7bb2905232.jpeg',
            'ee51c4fc65488c23e7a95a09d27999b082ee7f8a.jpeg',
            'efa9411aa6e5eb0ada1bfbd9bb818c175ba31703.jpeg',
            'fc76fc4ab1a1732660615b49204042caa14dcbcc.jpeg',
            'fe7cc7969b5af7ef5c74ad6234042c855c6f1c7e.jpeg',
            'fe7cc7969b5af7ef5c74ad6234042c855c6f1c7e2.jpeg'
        );
        $nbreCar = count($manager->getRepository("JcJolieCarBundle:Modele")->findAll());
        foreach($listeImage as $i => $image){
            $images[$i] = new Image();
            $file = new File(__DIR__.'/../../../../../web/images/fixtures/'.$image);
            $images[$i]->setFile($file);
            $images[$i]->setVoiture($this->getReference('voiture'.rand(1,$nbreCar-1)));
            $manager->persist($images[$i]);
        }

        /*for($i=1;$i<=8;$i++)
        {
            for($j=1;$j<=3;$j++)
            {
                $images[$j] = new Image();
                
                $voiture = $this->getReference('voiture'.($i-1));
                $images[$j]->setPath($i.'_'.$j.'.jpg');
                $images[$j]->setNom($i.'_'.$j.'.jpg');
                $images[$j]->setFile(new UploadedFile(__DIR__.'/../../../../../web/images/cars/4_1.jpg',"2_2.jpg"));
                $images[$j]->setVoiture($voiture);
                if($j==1){
                    $images[$j]->setMainImage(true);
                    $voiture->setMainImage($images[$j]);

                }
                $manager->persist($images[$j]);
            }
        }*/
        $manager->flush();
    }

}


