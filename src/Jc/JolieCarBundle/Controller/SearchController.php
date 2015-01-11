<?php
//src/Jc/JolieCarBundle/Controller/SearchController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Jc\JolieCarBundle\Form\SearchVoitureType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/search",name="jc_search")
     */
    public function shortSearchAction()
    {
        $form = $this->createForm(new SearchVoitureType());
        $em = $this->getDoctrine()->getManager();
        
        //$marque = $em->getRepository("JcJolieCarBundle:Marque")->getModele();

        $request = $this->get('request');

        if($request->isXmlHttpRequest()){
            $key = $request->request->get('query');

            $indexJc = $this->get('fos_elastica.index.jc');

            $resultat = $indexJc->search($key)->getResults();

            $serializer = $this->get('jms_serializer');

            $resultatJson = $serializer->serialize($resultat,'json');

            return new Response($resultatJson);

        }
        return $this->render("JcJolieCarBundle:JolieCar:search.html.twig",array(
            'form' => $form->createView(),
            //'marque' => json_encode($marque),
        ));
    }

}

