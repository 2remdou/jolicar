<?php

namespace Jc\JolieCarBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jc\JolieCarBundle\Entity\ModeleRepository;
use Doctrine\ORM\EntityManager;

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
        $listeMarque = $this->em->getRepository('JcJolieCarBundle:Modele')->getMarque();
        $builder
            ->add('marque', 'entity',array(
                'class' => 'Jc\JolieCarBundle\Entity\Marque',
                'property' => 'nom',
                'label' => false,
                'required' => false,
                'attr'=>array(
                    'placeholder' => 'Marque',
                )
                
                )
            )
           ->add('nom','entity',array(
                'class' => 'JcJolieCarBundle:Modele',
                'property' => 'nom',
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Modele'
                ),
                'liste_marque' => $listeMarque,
                'required' => false,
                'query_builder' => function(ModeleRepository $rep){
                return $rep->createQueryBuilder('m');
                },
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
        return 'modele';
    }
}
