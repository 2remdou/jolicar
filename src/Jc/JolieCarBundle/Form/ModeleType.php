<?php

namespace Jc\JolieCarBundle\Form;

use Jc\JolieCarBundle\Form\DataTransformer\ModelIdToModeleTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Jc\JolieCarBundle\Entity\ModeleRepository;
use Doctrine\ORM\EntityManager;
use Jc\JolieCarBundle\Form\Extension\ListeModele;
use Jc\JolieCarBundle\Form\EvenListener\ModeleSubscriber;
use Jc\JolieCarBundle\Form\EvenListener\UpdateAfterModeleSubscriber;
use Jc\JolieCarBundle\Form\DataTransformer\ViewIdToModeleTransformer;

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
        /*$listeModele = $this->em->getRepository("JcJolieCarBundle:Modele")->getAllModeleArray();
        $listeMarque = $this->em->getRepository('JcJolieCarBundle:Modele')->getMarque();
        $choices = array();
        foreach($listeModele as $modele){
            $choices[$modele['id']] = $modele['nom'];
        }

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
            );
*/
        $builder->addEventSubscriber(new ModeleSubscriber($this->em));


    }

    /**
     * @param FormView $view
     * @param FormInterface $form
     * @param array $options
     */
    public function buildView(FormView $view,FormInterface $form, array $options){

        $view->vars = array_replace($view->vars,array(
                'liste_marque' => $options['liste_marque'],
            ));
    }
        /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Jc\JolieCarBundle\Entity\Modele',
            'liste_marque' => null,
            
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
