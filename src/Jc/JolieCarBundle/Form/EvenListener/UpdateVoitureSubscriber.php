<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 30/11/14
 * Time: 21:22
 */

namespace Jc\JolieCarBundle\Form\EvenListener;

use Jc\JolieCarBundle\Form\Extension\ListeMarque;
use Jc\JolieCarBundle\Form\Extension\ListeModele;
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
            FormEvents::PRE_SET_DATA => 'preSetData',
        );
    }
    public function preSetData(FormEvent $event){
        $form = $event->getForm();
        $voiture = $event->getData();
        $marque =  $voiture->getModele()->getMarque();

        $options = array(
            'choice_list' => new ListeMarque($this->em),
            'required' => false,
            'label' => false,
            'mapped' => false,
            'attr' => array(
                'placeholder' => 'Marque',
            ),
        );

        if($marque !== null){
            $options['data']  = $marque->getId();
        }

        $form->add('marque','choice',$options);

    }

}