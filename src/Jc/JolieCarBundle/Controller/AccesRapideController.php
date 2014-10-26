<?php
//src/Jc/JolieCarBundle/Controller/AccesRapideController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
class AccesRapideController extends Controller{
    
    public function tabAccesAction()
    {
        $em = $this->getDoctrine()->getManager();

        $listeTopCars = $em->getRepository("JcJolieCarBundle:Voiture")->getTopCar();
        return $this->render('JcJolieCarBundle::tabAccesRapide.html.twig',array(
            'topCars' => $listeTopCars,
        ));
    }
   
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

