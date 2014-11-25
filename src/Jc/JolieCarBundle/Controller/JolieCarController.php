<?php
//src/Jc/JolieCarBundle/Controller/JolieCarController.php

namespace Jc\JolieCarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Response;
use Jc\JolieCarBundle\Form\VoitureType;
use Jc\JolieCarBundle\Form\MarqueType;
use Jc\JolieCarBundle\Form\AjoutModeleType;
use Jc\JolieCarBundle\Entity\Voiture;
use Jc\JolieCarBundle\Form\HeaderSearchType;
use Jc\JolieCarBundle\Entity\Modele;
use Jc\JolieCarBundle\Entity\Marque;
class
JolieCarController extends Controller
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
     *
     * @param type $marque
     * @param type $modele
     * @param type $id
     * @return type
     * @Route("/update/{marque}-{modele}-{id}",name="update_car",requirements={"id" = "\d+"})
     */
    public function updateCar($marque, $modele, $id)
    {
        $em = $this->getDoctrine()->getManager();

        //$car = $em->getRepository("JcJolieCarBundle:Voiture")->findByIdwithAllInformation($id);
        $car = $em->getRepository("JcJolieCarBundle:Voiture")->findByIdwithAllInformation($id);
        if($car === null)
        {
            return  $this->createNotFoundException("Aucune voiture à cette adresse");
        }
        return $this->render("JcJolieCarBundle:JolieCar:updateCar.html.twig",array(
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
        $request = $this->get('request');
        $session = $this->get("session");
        $form->handleRequest($request);
        if($request->isMethod("POST")) {
            $errors = $form->getErrors(true);
            if (count($errors)<=0) {
                $em = $this->getDoctrine()->getManager();
                $idModele = $car->getModele()->getNom();
                $modele = $em->getRepository("JcJolieCarBundle:Modele")->find($idModele);
                $car->setModele($modele);
/*                $images = $car->getImages();
                foreach($images as $image){
                    if($image===null){

                    }
                }*/
                $em->persist($car);
                $em->flush();
                $session->getFlashBag()->add('message', 'Votre annonce à bien été enregistré');

               // return $this->redirect($this->generateUrl('add_car'));
            } else {
                $mesErreur = array();
                foreach($errors as $error){
                    $mesErreur[] = $error->getCause().":".$error->getMessage();
                }
                $mesMessage = "<h5>".implode("<br>",$mesErreur)."</h5>";
                $session->getFlashBag()->add('message', "Erreur lors de l'enregistrement <br>".$mesMessage);

                //return $this->redirect($this->generateUrl('add_car'));
            }
        }

        return $this->render("JcJolieCarBundle:JolieCar:addCar.html.twig",array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/listMarque", name="list_marque")
     */
    public function listMarque(){
        return;
    }
    /**
     * @Route("/ajoutMarque", name="add_marque")
     */
    public function addMarque()
    {
        $em = $this->getDoctrine()->getManager();
        $marque = new Marque();
        $request = $this->get('request');    
            if($request->isXmlHttpRequest())
            {
                $marque->setNom($request->request->get('nom'));
                $serializer = $this->get('jms_serializer');
                //*** la validation*****
                $validator = $this->get('validator');
                $errors = $validator->validate($marque);
                if(count($errors)<=0){
                    $em->persist($marque);
                    $em->flush();

                    $monJson = $serializer->serialize(array(
                            'message' => 'La nouvelle marque à été ajouté avec succes',
                            'marque' => $serializer->serialize($marque,'json'),
                            'typeMessage'=>'success',
                        ),
                        'json');
                    return new Response($monJson);
                }
                else
                {
                    $monJson = $serializer->serialize(array(
                            'message' => $serializer->serialize($errors,'json'),
                            'typeMessage' => 'danger'
                        ),
                         'json');
                    return new Response($monJson);
                }


            }
    }
    
    /**
     * @Route("/ajoutModele",name="add_modele")
     */
    public function addModele()
    {
        $modele = new Modele();
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $serializer = $this->get('jms_serializer');
        if($request->isXmlHttpRequest())
        {
            $post = $request->request;
            $validator = $this->get('validator');
            $marque = $em->getRepository('JcJolieCarBundle:Marque')->find($post->get('marque'));
            if($marque != null){
                $modele->setMarque($marque);
                $modele->setNom($post->get('nom'));
                //******* la validation*****
                $errors = $validator->validate($modele);
                if(count($errors)<=0){
                    $em->persist($modele);
                    $em->flush();
                    $monJson = $serializer->serialize(array(
                            'message' => 'Le nouveau modele à été ajouté avec succes',
                            'newModele' => $serializer->serialize($modele,'json'),
                            'typeMessage' => 'success'
                        ),
                        'json');
                    return new Response($monJson);
                }
                else
                {
                    $monJson = $serializer->serialize(array(
                            'message' => $serializer->serialize($errors,'json'),
                            'typeMessage' => 'danger'
                        ),
                        'json');
                    return new Response($monJson);
                }



            }
            else {
                $monJson = $serializer->serialize(array(
                       'message' =>  "La marque selectionnée n'existe pas",
                    ),
                    'json');
               return new Response($monJson);
           }
        }
        
    }
}

