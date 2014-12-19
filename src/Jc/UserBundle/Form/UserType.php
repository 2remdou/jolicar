<?php

namespace Jc\UserBundle\Form;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{

    private $em;

    public function __construct(EntityManager $em){
        $this->em = $em;
    }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom','text',array(
                'attr' => array(
                    'placeholder' => 'Veuillez fournir votre nom',
                ),
            ))
            ->add('autreNom','text',array(
                'required' => false,
                'label' => 'Prenom',
                'attr' => array(
                    'placeholder' => 'Veuillez fournir votre prenom',
                ),
            ))
           ->add('typeUser','entity',array(
                'class' => 'JcUserBundle:TypeUser',
                'property' => 'nom',
                'expanded' => true,
                'multiple' => false,

            ))
            ->add('adresse','jc_adresse')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\UserBundle\Entity\User'
        ));
    }

    public function getParent(){
        return 'fos_user_registration';
    }
    /**
     * @return string
     */
    public function getName()
    {
        return 'jc_user_registration';
    }
}
