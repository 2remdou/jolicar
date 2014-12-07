<?php
//src/Jc/JolieCarBundle/Form/Extension/ModeleTypeExtension.php

namespace Jc\JolieCarBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormInterface;

class ModeleTypeExtension extends AbstractTypeExtension
{
    public function buildView(FormView $view, FormInterface $form, array $options) {
        $view->vars = array_replace($view->vars, array(
            'liste_marque' => $options['liste_marque'],
            'optionSelect' => $options['optionSelect'] ,
        ));
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'liste_marque' => array(),
            'optionSelect' => null,
        ));
    }

    public function getExtendedType() {
        return 'choice';
    }

}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

