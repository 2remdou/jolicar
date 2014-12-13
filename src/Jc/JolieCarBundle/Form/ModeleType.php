<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jc\JolieCarBundle\Entity\ModeleRepository;
use Doctrine\ORM\EntityManager;
use Jc\JolieCarBundle\Form\Extension\ListeModele;
use Jc\JolieCarBundle\Form\EvenListener\AddNameModeleSubscriber;
use Jc\JolieCarBundle\Form\EvenListener\UpdateAfterModeleSubscriber;
use Jc\JolieCarBundle\Form\DataTransformer\IdToModeleTransformer;

class ModeleType extends AbstractType
{
    
    private $em;
    public function __construct(EntityManager $em) {
        $this->em=$em ;
        }
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder
            ->add('marque', 'entity',array(
                'class' => 'JcJolieCarBundle:Marque',
                'property' => 'nom',
                'label' => false,
                'required' => false,
                'attr'=>array(
                    'placeholder' => 'Marque',
                )
                
                )
            );
         $builder->addEventSubscriber(new AddNameModeleSubscriber($this->em));
         //$builder->addEventSubscriber(new UpdateAfterModeleSubscriber($this->em));
        // $builder->addModelTransformer(new IdToModeleTransformer($this->em));

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
        return 'modele';
    }

}
