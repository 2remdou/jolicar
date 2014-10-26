<?php
//src/Jc/JolieCarBundle/Controller/JolieCarController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\JolieCarBundle\Form\HeaderSearchType;
class JolieCarController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->getAll();
              
        return $this->render("JcJolieCarBundle:JolieCar:index.html.twig",array(
            'listeCar' => $listeCar,          
        ));
    }
    public function headerSearchAction()
    {
        $formHeader = $this->createForm(new HeaderSearchType()); 
        return $this->render("JcJolieCarBundle::headerSearch.html.twig",array(
            'formHeader' => $formHeader->createView(),            
        ));
    }
    public function detailAction($marque, $modele, $id)
    {
        $em = $this->getDoctrine()->getManager();
        
        //$car = $em->getRepository("JcJolieCarBundle:Voiture")->findByIdwithAllInformation($id);
        $car = $em->getRepository("JcJolieCarBundle:Voiture")->findByIdwithAllInformation($id);
        if($car === null)
        {
            return  $this->createNotFoundException("Aucune voiture à cette adresse");
        }
        return $this->render("JcJolieCarBundle:JolieCar:detail.html.twig",array(
            'car' => $car,
        ));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

