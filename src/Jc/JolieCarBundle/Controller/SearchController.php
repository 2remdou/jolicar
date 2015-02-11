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
     * @Route("/search",name="jc_search",options={"expose"=true})
     */
    public function shortSearchAction()
    {
        $form = $this->createForm(new SearchVoitureType());
        $em = $this->getDoctrine()->getManager();

        $request = $this->get('request');

        /*if($request->isXmlHttpRequest()){
            $key = $request->request->get('query');

            $repostoryManager = $this->get('fos_elastica.manager.orm');
            $repository = $repostoryManager->getRepository("JcJolieCarBundle:Voiture");
            $cars = $repository->find($key);
            if($cars == null){
                $carType = $this->get('fos_elastica.index');
//                $repository = $this->get('jc_joliecarbundle.elastica.voiture.repository');
                $cars = $carType->search($repository->search($key));
            }
            $serializer = $this->get('jms_serializer');

            $resultatJson = $serializer->serialize($cars,'json');

            return new Response($resultatJson);

        }*/

        return $this->render("JcJolieCarBundle:JolieCar:search.html.twig",array(
            'form' => $form->createView(),
            //'marque' => json_encode($marque),
        ));
    }

}

