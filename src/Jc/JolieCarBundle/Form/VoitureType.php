<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jc\JolieCarBundle\Form\ModeleType;

class VoitureType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('modele','modele',array(
                'label' => false,
            ))
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
            ->add('prix','number',array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Veuillez fournir le prix'
                )
            ))
            ->add('kmParcouru','number',array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Veuillez fournir le nombre de Km parcourus',
                ))
                )
            ->add('dateAcquisition','birthday',array(
                'required' => false,
                'label' => false,
                'format' => 'yyyyMMdd',
                'years' => range(date('Y'), date('Y')-50),
                'months' => range(1, 12),
                'empty_value' => array(
                    'year' => 'Année',
                    'month' => 'Mois',
                    'day' => 'Jour'
                ),
                'attr' => array(
                    'placeholder' => "Veuillez fournir la date d'acquisition",
                ))
                    )
            ->add('images','collection',array(
                   'type' => new ImageType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                ))
            ->add('nombreRoueMotrice','number',array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Veuillez fournir le nombre de roues motrices',
            ))
            )
            ->add('nombrePorte','number',array(
                'required' => false,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Veuillez fournir le nombre de portes',
                ))
            )
            ->add('nombreSiege','number',array(
                    'required' => false,
                    'label' => false,
                    'attr' => array(
                        'placeholder' => 'Veuillez fournir le nombre de sieges',
                    ))
                )
            ->add('btnSave','submit',array(
                    'label' => 'Enregistrer',
                ))
////            ->add('top')
////            ->add('newCar')
//            ->add('modele')
//            ->add('boitier')
//            ->add('parc')
//            ->add('carburant')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\JolieCarBundle\Entity\Voiture'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jc_joliecarbundle_voiture';
    }
}
