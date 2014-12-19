<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdresseType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('telephone',null,array(
                'attr' => array(
                    'placeholder' => 'Veuillez saisir votre numero de telephone',
                ),
                'required'=>false,
            ))
            ->add('site',null,array(
                'attr' => array(
                    'placeholder' => "Veuillez saisir l'adresse de votre site internet",
                ),
                'required'=>false,
            ))
            ->add('ville',null,array(
                'attr' => array(
                    'placeholder' => 'Veuillez saisir votre ville de residence',
                ),
                'required'=>false,
            ))
            ->add('quartier',null,array(
                'attr' => array(
                    'placeholder' => 'Veuillez saisir votre quartier',
                ),
                'required'=>false,
            ))
            ->add('indicationLieu','textarea',array(
                'attr' => array(
                    'placeholder' => 'Veuillez saisir une indication precise du lieu.
                    Exemple: En face de la station Total au rond point tanerie',
                    //'rows' => 3,
                    //'cols' =>75,
                ),
                'required'=>false,
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\JolieCarBundle\Entity\Adresse'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'jc_adresse';
    }
}
