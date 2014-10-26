<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SearchVoitureType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prixMin','text',array( 
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prix minimal',
                )
                
            ))
            ->add('prixMax','text',array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Prix maximal',
                )   
            ))
            ->add('modele','modele')
            ->add('boitier','entity',array(
                'class' => 'JcJolieCarBundle:Boitier',
                'property' => 'nom',
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Boite à vitesse',
                ),
            ))
            ->add('carburant','entity',array(
                'class' => 'JcJolieCarBundle:Carburant',
                'property' => 'nom',
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Carburant',
                ),
            ))
           ->add('rechercher','submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
//    public function setDefaultOptions(OptionsResolverInterface $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => 'Jc\JolieCarBundle\Entity\Voiture'
//        ));
//    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jc_joliecarbundle_searchvoiture';
    }
}
