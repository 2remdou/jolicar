<?php
//src/Jc/JolieCarBundle/Controller/JolieCarController.php

namespace Jc\JolieCarBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Jc\JolieCarBundle\Model\FormErrorManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
use Jc\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class JolieCarController extends Controller
{
    /**
     * 
     * @Route("/",name="joliecar_accueil", options={"expose"=true})
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $nbreParPage = $this->container->getParameter('max_car_per_page');
        $page = 1;
        $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->listByPage($page,$nbreParPage);

        return $this->render("JcJolieCarBundle:JolieCar:index.html.twig",array(
                'listeCar' => $listeCar,
            ));
    }

    /**
     * @Route("/liste-voitures/{page}",name="list_car", options={"expose"=true})
     */
    public function listCarAction($page=1){
        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $page = $request->query->get('page');
            $em = $this->getDoctrine()->getManager();
            $nbreParPage = $this->container->getParameter('max_car_per_page');
            $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->listByPage($page,$nbreParPage);
            $listeCar = $listeCar->getIterator()->getArrayCopy();
            if($listeCar !== null){
                $serializer = $this->get('jms_serializer');
                $listeCarJson =$serializer->serialize($listeCar,'json');
                return new Response($listeCarJson,200);
            }
            return new Response("Aucune voiture",200);
        }
        return new Response("Error",200);

    }


    /**
     * @Route("/shortSearch",name="jc_short_search", options={"expose"=true})
     */
    public function headerSearchAction()
    {
        $formHeader = $this->createForm(new HeaderSearchType());
        $request = $this->get('request');
        /*if($request->isMethod("POST")){
            $formHeader->handleRequest($request);
            if($formHeader->isValid()){
                $repostoryManager = $this->get('fos_elastica.manager.orm');
                $repository = $repostoryManager->getRepository("JcJolieCarBundle:Voiture");
                $listeCar = $repository->find($formHeader->get('rechercher'));
                //recherche dans modele et marque (tokenizer)
                if($listeCar == null){
                    $carType = $this->get('fos_elastica.index');
                    $listeCar = $carType->search($repository->search($formHeader->get('rechercher')));
                }

                return $this->render("JcJolieCarBundle:JolieCar:index.html.twig",array(
                        'listeCar' => $listeCar,
                    ));
            }
        }*/
        if($request->isXmlHttpRequest()){
            $key = $request->request->get('query');

            $repostoryManager = $this->get('fos_elastica.manager.orm');
            $repository = $repostoryManager->getRepository("JcJolieCarBundle:Voiture");
            $carType = $this->get('fos_elastica.index');
            $cars = $carType->search($repository->search($key));
            $serializer = $this->get('jms_serializer');

            $resultatJson = $serializer->serialize($cars,'json');

            return new Response($resultatJson);

        }
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
//        $beforeImages = new ArrayCollection();
        $beforeImages = $car->getImages();
        $beforeMainImage = $car->getMainImage();

        /*foreach($car->getImages() as $image){
                $beforeImages->add($image);
         }*/
        if($request->isMethod("POST")) {

            $form->handleRequest($request);
            $errors = $form->getErrors(true);
            $afterMainImage = $car->getMainImage();
            if (count($errors)<=0) {
                foreach($beforeImages as $image){
                    if(!$car->getImages()->contains($image)){
                        $em->remove($image);
                    }
                }
                if($beforeMainImage !== $afterMainImage && $beforeMainImage !== null){
                    $beforeMainImage->setMainImage(false);
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
     * @Route("/mes-voitures/{page}",name="owner_car", requirements={"page" = "\d+"}, defaults={"page" = 1},options={"expose"=true})
     * @Security("has_role('ROLE_USER')")
     */
    public function ownerCarAction($page){
        $user = $this->getUser();

        return $this->listCarByUserAction($user,$page);
    }
    /**
     *
     * @Route("/{user}-{id}{page}",name="list_car_by_user", requirements={"page" = "\d+","id" = "\d+"}, defaults={"page" = 1}, options={"expose"=true})
     * @ParamConverter("user", class="JcUserBundle:User", options={"id"="id"})
     */
    public function listCarByUserAction(User $user,$page)
    {
        if($user === null){
            return $this->createNotFoundException("Utilisateur inconnu");
        }

        $em = $this->getDoctrine()->getManager();
        $nbreParPage = $this->container->getParameter('max_car_per_page');

        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $page = $request->query->get('page');
            $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->listeByUserByPage($user->getId(),$page,$nbreParPage);
            $listeCar = $listeCar->getIterator()->getArrayCopy();
            if($listeCar !== null){
                $serializer = $this->get('jms_serializer');
                $listeCarJson =$serializer->serialize($listeCar,'json');
                return new Response($listeCarJson,200);
            }
            return new Response("Aucune voiture",200);
        }
        else{
            $listeCar = $em->getRepository("JcJolieCarBundle:Voiture")->listeByUserByPage($user->getId(),$page,$nbreParPage);

            return $this->render("JcJolieCarBundle:JolieCar:listeByUser.html.twig",array(
                    'listeCar' => $listeCar,
                ));
        }
    }
    /**
     *
     * @Route("/statistique",name="statistique_laterale", options={"expose"=true})
     */
    public function statistiqueLateraleAction()
    {
        $em = $this->getDoctrine()->getManager();
        $statatisqueMarque = $em->getRepository("JcJolieCarBundle:Voiture")->statistiqueByMarque();
        $statatisqueModele = $em->getRepository("JcJolieCarBundle:Voiture")->statistiqueByModele();

        return $this->render("JcJolieCarBundle:JolieCar:statistiqueLaterale.html.twig",array(
                'statistiquesMarque' => $statatisqueMarque,
                'statistiquesModele' => $statatisqueModele,
            ));
    }
}

