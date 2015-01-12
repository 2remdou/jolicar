<?php
//src/Jc/UserBundle/Controller/RegistrationController.php
/**
 * Created by PhpStorm.
 * User: mdoutoure
 * Date: 17/12/2014
 * Time: 17:54
 */

namespace Jc\UserBundle\Controller;

use FOS\UserBundle\Doctrine\UserManager;
use Jc\JolieCarBundle\Entity\Adresse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class UpdateController extends  BaseController {

    /**
     * @param Request $request
     * @Route("/update-user",name="update_user")
     */
    public function UpdateAction(Request $request)
    {
        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
        $formFactory = $this->container->get('fos_user.registration.form.factory');
        /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
        $userManager = $this->container->get('fos_user.user_manager');
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');

        $user = $this->getUser();
//        $user->setEnabled(true);
//
//        $dispatcher->dispatch(FOSUserEvents::REGISTRATION_INITIALIZE, new UserEvent($user, $request));

        $form = $formFactory->createForm();
        $form->setData($user);

/*        if ('POST' === $request->getMethod()) {
            $attributForm = $request->request->get('fos_user_registration_form');
            $attributForm =  array_replace($attributForm,array(
                   'username' => $attributForm['email'],
                ));
            $request->request->set('fos_user_registration_form',$attributForm);
            //$request->request->set('username',$request->request->get('email'));
            $form->bind($request);

            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_SUCCESS, $event);

                $userManager->updateUser($user);

                if (null === $response = $event->getResponse()) {
                    //$url = $this->container->get('router')->generate('fos_user_registration_confirmed');
                    $url = $this->container->get('router')->generate('joliecar_accueil');
                    $response = new RedirectResponse($url);
                }

                $dispatcher->dispatch(FOSUserEvents::REGISTRATION_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

                return $response;
            }
        }*/

        return $this->container->get('templating')->renderResponse('JcUserBundle:Update:update.html.twig', array(
                'form' => $form->createView(),
            ));
    }

    /**
     * @Route("/update-info-user",name="update_info_user")
     */
    public function updateInfoAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $user = $this->getUser();

            $typeUser = $em->getRepository("JcUserBundle:TypeUser")->find($request->request->get('typeUser'));
            $user->setNom($request->request->get('nom'));
            $user->setAutreNom($request->request->get('autreNom'));
            $user->setEmail($request->request->get('email'));
            $user->setTypeUser($typeUser);

            $validator = $this->get('validator');
            $errors = $validator->validate($user,array('Profile'));

            $serializer = $this->get('jms_serializer');

            if(count($errors)<=0){
                $em->flush();

                $result = array(
                    'message' => 'Modification effectuee avec succes',
                    'typeMessage'=>'success'
                );
                $monJson = $serializer->serialize($result,'json');
                return new Response($monJson);
            }
            else{
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
     * @Route("/update-adresse",name="update_adresse")
     */
    public function updateAdresseAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $user = $this->getUser();
            $adresse = $user->getAdresse();
            /*if($adresse === null){
                $adresse = new Adresse();
            }
            */
            $adresse->setTelephone($request->request->get('telephone'));
            $adresse->setSite($request->request->get('site'));
            $adresse->setVille($request->request->get('ville'));
            $adresse->setQuartier($request->request->get('quartier'));
            $adresse->setIndicationLieu($request->request->get('indicationLieu'));

            $validator = $this->get('validator',array('Profile'));
            $errors = $validator->validate($user);

            $serializer = $this->get('jms_serializer');

            if(count($errors)<=0){
                $em->flush();

                $result = array(
                    'message' => 'Modification effectuee avec succes',
                    'typeMessage'=>'success'
                );
                $monJson = $serializer->serialize($result,'json');
                return new Response($monJson);
            }
            else{
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
     * @Route("/update-userp",name="update_password")
     */
    public function updatePasswordAction(){
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        if($request->isXmlHttpRequest()){
            $user = $this->getUser();

            $password1 = $request->request->get('password1');
            $password2 = $request->request->get('password2');

            $serializer = $this->get('jms_serializer');

            if(strlen($password1)==0 || $password1 !== $password2){
                $monJson = $serializer->serialize(array(
                        'message' => 'Veuillez fournir des mots de passe identiques et non vide',
                        'typeMessage' => 'danger'
                    ),
                    'json');
                return new Response($monJson);
            }

            $userManager = $this->get('fos_user.user_manager');
            $user->setPlainPassword($password1);
            $userManager->updatePassword($user);

            $validator = $this->get('validator',array('Profile'));
            $errors = $validator->validate($user);



            if(count($errors)<=0){
                $em->flush();

                $result = array(
                    'message' => 'Mot de passe modifié avec succes',
                    'typeMessage'=>'success'
                );
                $monJson = $serializer->serialize($result,'json');
                return new Response($monJson);
            }
            else{
                $monJson = $serializer->serialize(array(
                        'message' => $serializer->serialize($errors,'json'),
                        'typeMessage' => 'danger'
                    ),
                    'json');
                return new Response($monJson);
            }
        }
    }
} 