<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 30/11/14
 * Time: 07:58
 */

namespace Jc\JolieCarBundle\Form\EvenListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;

class ModeleSubscriber implements EventSubscriberInterface  {

    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;

    }
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }

    public function preSetData(FormEvent $event){
        $listeModele = $this->em->getRepository("JcJolieCarBundle:Modele")->getAllModeleArray();
        $listeMarque = $this->em->getRepository('JcJolieCarBundle:Modele')->getMarque();
        $choices = array();
        foreach($listeModele as $modele){
            $choices[$modele['id']] = $modele['nom'];
        }
        $mod = $event->getData();
        $form = $event->getForm();
        if(!$mod|| null === $mod->getId()){

            $form->add('nom','choice',array(
                    'choices' => $choices,
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Modele'
                    ),
                    'liste_marque' => $listeMarque,
                    'required' => false,

                ));
        }
        else
        {
            $form->add('nom','choice',array(
                    'choices' => $choices,
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Modele'
                    ),
                    'liste_marque' => $listeMarque,
                    'required' => false,
                    'optionSelect' => (string)$mod->getId(),

                ));
        }

    }


}