<?php
//src/Jc/JolieCarBundle/Controller/JolieCarController.php

namespace Jc\JolieCarBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Jc\JolieCarBundle\Model\FormErrorManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use JMS\SecurityExtraBundle\Annotation\PreAuthorize;
use Symfony\Component\HttpFoundation\Response;
use Jc\JolieCarBundle\Form\VoitureType;
use Jc\JolieCarBundle\Form\MarqueType;
use Jc\JolieCarBundle\Form\AjoutModeleType;
use Jc\JolieCarBundle\Entity\Voiture;
use Jc\JolieCarBundle\Form\HeaderSearchType;
use Jc\JolieCarBundle\Entity\Modele;
use Jc\JolieCarBundle\Entity\Marque;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JolieCarController extends Controller
{
    /**
     * 
     * @Route("/",name="joliecar_accueil", options={"expose"=true})
     */
    public function indexAction()
    {
        return $this->render("JcJolieCarBundle:JolieCar:index.html.twig");
    }

    /**
     * @Route("/liste-voitures",name="list_car", options={"expose"=true})
     */
    public function listCarAction(){
        $request = $this->get('request');

        if(!$request->isXmlHttpRequest()){
            return new Response("",404);
        }
        $em = $this->getDoctrine()->getManager();

        $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->find(1);

        $serializer = $this->get('jms_serializer');

        $listeCarJson = $serializer->serialize($listeCar,'json');
        return new Response($listeCarJson,200);

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
     * @Route("/detail/{marque}-{modele}-{id}",name="joliecar_detail",requirements={"id" = "\d+"}, options={"expose"=true})
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
     * @Route("/update/{marque}-{modele}-{id}",name="update_car",requirements={"id" = "\d+"}, options={"expose"=true})
     * @Security("has_role('ROLE_USER')")
     */
    public function updateCarAction($marque, $modele, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        if(!$em->getRepository("JcJolieCarBundle:Voiture")->isForUser($id,$user)){
            throw $this->createAccessDeniedException('Vous ne pouvez modifier cette voiture, car elle ne vous appartient pas');
        }
        $request = $this->get('request');
        $session = $this->get('session');
        $car = $em->getRepository("JcJolieCarBundle:Voiture")->findByIdwithAllInformation($id);
        $form = $this->createForm(new VoitureType($em),$car);

        if($car === null)
        {
            return  $this->createNotFoundException("Aucune voiture à cette adresse");
        }
        $originalImages = new ArrayCollection();
        $originalMainImage = $car->getMainImage();

        foreach($car->getImages() as $image){
            if(!$image->isMainImage()){
                $originalImages->add($image);
            }

         }
        if($request->isMethod("POST")) {

            $form->handleRequest($request);
            $errors = $form->getErrors(true);
            if (count($errors)<=0) {
                if($originalMainImage !== $car->getMainImage() && $originalMainImage !== null){
                    $originalMainImage->setMainImage(false);
                }
                foreach($originalImages as $image){
                    if(!$car->getImages()->contains($image) && !$image->isMainImage()){
                        $em->remove($image);
                    }
                }
                $em->flush();
                $session->getFlashBag()->add('message', 'Votre annonce a bien été modifié');
                return $this->redirect($this->generateUrl('joliecar_detail',array(
                            'marque' => $car->getModele()->getMarque()->getNom(),
                            'modele' => $car->getModele()->getNom(),
                            'id' => $car->getId(),

                        )));
            } else {
                $mesMessage = new FormErrorManager($errors);
                $session->getFlashBag()->add('message', "Erreur lors de la modification <br>".$mesMessage->listError());

            }
        }
        return $this->render("JcJolieCarBundle:JolieCar:updateCar.html.twig",array(
                'form' => $form->createView(),
            ));
    }
    /**
     *@Route("/ajout", name="add_car", options={"expose"=true})
     * @Security("has_role('ROLE_USER')")
     */
    public function addCarAction()
    {
        $em = $this->getDoctrine()->getManager();
        $car = new Voiture();
        $form = $this->createForm(new VoitureType($em),$car);
        $request = $this->get('request');
        $session = $this->get("session");

        if($request->isMethod("POST")) {
            $form->handleRequest($request);
            $errors = $form->getErrors(true);
            if (count($errors)<=0) {
                $user = $this->getUser();
                $car->setUser($user);
                $em->persist($car);
                $em->flush();
                $session->getFlashBag()->add('message', 'Votre annonce a bien été enregistré');

                //return $this->redirect($this->generateUrl('add_car'));
            } else {
                $mesMessage = new FormErrorManager($errors);

                $session->getFlashBag()->add('message', "Erreur lors de l'enregistrement <br/>".$mesMessage->listError());
            }
        }

        return $this->render("JcJolieCarBundle:JolieCar:addCar.html.twig",array(
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/listMarque", name="list_marque")
     */
    public function listMarqueAction(){
        return;
    }
    /**
     * @Route("/ajoutMarque", name="add_marque", options={"expose"=true})
     */
    public function addMarqueAction()
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
                            'message' => 'La nouvelle marque a été ajouté avec succes',
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
     * @Route("/ajoutModele",name="add_modele", options={"expose"=true})
     */
    public function addModeleAction()
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
                            'message' => 'Le nouveau modele a été ajouté avec succes',
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
    /**
     *
     * @Route("/mes-voitures",name="list_by_user", options={"expose"=true})
     * @Security("has_role('ROLE_USER')")
     */
    public function listCarByUserAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->findByUser($user->getId());

        return $this->render("JcJolieCarBundle:JolieCar:listeByUser.html.twig",array(
                'listeCar' => $listeCar,
            ));
    }
}

