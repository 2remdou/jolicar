<?php
//src/Jc/JolieCarBundle/DataFixtures/ORM/LoadParcData.php

namespace Jc\JolieCarBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface{
    public function getOrder() {
        return 6;
    }

    public function load(ObjectManager $manager) {
        $listeUser = array(
            array(
                'nom' => 'Administrateur',
                'username' => 'admin',
            ),
            array(
                'nom' => 'Toure',
                'username' => 'toure',
            ),
            array(
                'nom' => 'Sidibe',
                'username' => 'sidibe',
            ),
            array(
                'nom' => 'Toure & Frere',
                'username' => 'tfrere',
            ),
        );
       $listeIdAdresse = array();
       foreach ($listeUser as $i => $user) {
           $users[$i] = new User();
           $users[$i]->setNom($user['nom']);
           $users[$i]->setUsername($user['username']);
           $users[$i]->setPassword($user['username']);
           $users[$i]->setEmail($user['username'].'@joliecar.com');
           $users[$i]->setEnabled(true);
           $idAdresse = rand(0, count($manager->getRepository("JcJolieCarBundle:Adresse")->findAll())-1);
           if(!in_array($idAdresse,$listeIdAdresse)){
               $adresse = $this->getReference('adresse'.$idAdresse);
               $users[$i]->setAdresse($adresse);
               $listeIdAdresse[] = $idAdresse;
           }

           $typeUser = $this->getReference('typeUser'.rand(0, count($manager->getRepository("JcUserBundle:TypeUser")->findAll())-1));
           $users[$i]->setTypeUser($typeUser);
           if($user['username'] == 'admin'){
               $users[$i]->setSuperAdmin(true);
           }
           $manager->persist($users[$i]);
           //$nbreAdresse == count($manager->getRepository("JcJolieCarBundle:Adresse")->findAll())? $nbreAdresse=0 : $nbreAdresse++;
       
           $this->addReference('user'.$i, $users[$i]);
       }
       
       $manager->flush();
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

