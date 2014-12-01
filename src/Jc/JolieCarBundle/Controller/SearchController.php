<?php
//src/Jc/JolieCarBundle/Controller/SearchController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\JolieCarBundle\Form\SearchVoitureType;

class SearchController extends Controller
{
    public function shortSearchAction()
    {
        $form = $this->createForm(new SearchVoitureType());
        $em = $this->getDoctrine()->getManager();
        
        $marque = $em->getRepository("JcJolieCarBundle:Marque")->getModele();

        return $this->render("JcJolieCarBundle:JolieCar:search.html.twig",array(
            'form' => $form->createView(),
            'marque' => json_encode($marque),
        ));
    }
}

