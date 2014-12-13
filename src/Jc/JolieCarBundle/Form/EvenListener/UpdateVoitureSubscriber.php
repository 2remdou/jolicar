<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 30/11/14
 * Time: 21:22
 */

namespace Jc\JolieCarBundle\Form\EvenListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;

class UpdateVoitureSubscriber implements EventSubscriberInterface {

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
           // FormEvents::POST_SUBMIT => 'postSubmit',
            FormEvents::PRE_SUBMIT => 'preSubmit'
        );
    }
    public function preSubmit(FormEvent $event){
        $data = $event->getForm()->getData();
        $modele = $this->em->getRepository("JcJolieCarBundle:Modele")->findOneBy(array('id'=> $data->getModele()->getNom()));

        $data->setModele($modele);
    }
    public function postSubmit(FormEvent $event){
        $data = $event->getForm()->getData();
        $modele = $this->em->getRepository("JcJolieCarBundle:Modele")->findOneBy(array('id'=> $data->getModele()->getNom()));

        $data->setModele($modele);
    }
}