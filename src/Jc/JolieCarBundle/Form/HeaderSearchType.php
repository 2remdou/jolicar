<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class HeaderSearchType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rechercher','text',array( 
                'required' => true,
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Rechercher',
                    'size' => 40,
                )
                ))
           ->add('btnRechercher','submit',array(
                 'label' => 'Rechercher',
           ))
        ;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return 'jc_joliecarbundle_headerSearch';
    }
}
