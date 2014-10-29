<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AjoutModeleType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('marque', 'entity',array(
                'class' => 'Jc\JolieCarBundle\Entity\Marque',
                'property' => 'nom',
                'label' => false,
                'required' => false,
                'attr'=>array(
                    'placeholder' => 'Selectionner une marque Marque',
                )
                
                )
            )
           ->add('nom','text',array(
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Saisissez le nouveau modele'
                ),
               
                ));
    }


        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\JolieCarBundle\Entity\Modele',
            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'AjoutModele';
    }
}
