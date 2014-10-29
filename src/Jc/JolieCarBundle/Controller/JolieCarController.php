<?php
//src/Jc/JolieCarBundle/Controller/JolieCarController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Jc\JolieCarBundle\Form\VoitureType;
use Jc\JolieCarBundle\Form\MarqueType;
use Jc\JolieCarBundle\Form\AjoutModeleType;
use Jc\JolieCarBundle\Entity\Voiture;
use Jc\JolieCarBundle\Form\HeaderSearchType;
use Jc\JolieCarBundle\Entity\Modele;
use Jc\JolieCarBundle\Entity\Marque;
class JolieCarController extends Controller
{
    /**
     * 
     * @Route("/",name="joliecar_accueil")
     */
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
    /**
     * 
     * @param type $marque
     * @param type $modele
     * @param type $id
     * @return type
     * @Route("/detail/{marque}-{modele}-{id}",name="joliecar_detail",requirements={"id" = "\d+"})
     */
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
    /**
     *@Route("/ajout", name="add_car")
     */
    public function addCar()
    {
        $car = new Voiture();
        $form = $this->createForm(new VoitureType(),$car);
        return $this->render("JcJolieCarBundle:JolieCar:addCar.html.twig",array(
            'form' => $form->createView(),
        ));
    }
    public function addMarque()
    {
        $marque = new Marque();
        $form = $this->createForm(new MarqueType(), $marque);
        return $this->render();
    }
    /**
     * @Route("/ajoutModele",name="add_modele")
     */
    public function addModele()
    {
        $modele = new Modele();
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $form = $this->createForm(new AjoutModeleType(), $modele);
        if($request->isXmlHttpRequest())
        {
            return $this->render("JcJolieCarBundle:JolieCar:addModele.html.twig", array(
            'form' => $form->createView(),
            ));
        }
        
    }
}

