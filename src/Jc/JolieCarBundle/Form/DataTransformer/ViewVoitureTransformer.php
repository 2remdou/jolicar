<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 06/12/14
 * Time: 23:23
 */

namespace Jc\JolieCarBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class ViewVoitureTransformer implements DataTransformerInterface {

    private $em;

    public function __construct(ObjectManager $em){
        $this->em = $em;
    }
    /**
     * Transforms a value from the original representation to a transformed representation.
     *
     * This method is called on two occasions inside a form field:
     *
     * 1. When the form field is initialized with the data attached from the datasource (object or array).
     * 2. When data from a request is submitted using {@link Form::submit()} to transform the new input data
     *    back into the renderable format. For example if you have a date field and submit '2009-10-10'
     *    you might accept this value because its easily parsed, but the transformer still writes back
     *    "2009/10/10" onto the form field (for further displaying or other purposes).
     *
     * This method must be able to deal with empty values. Usually this will
     * be NULL, but depending on your implementation other empty values are
     * possible as well (such as empty strings). The reasoning behind this is
     * that value transformers must be chainable. If the transform() method
     * of the first value transformer outputs NULL, the second value transformer
     * must be able to process that value.
     *
     * By convention, transform() should return an empty string if NULL is
     * passed.
     *
     * @param mixed $value The value in the original representation
     *
     * @return mixed The value in the transformed representation
     *
     * @throws TransformationFailedException When the transformation fails.
     */
    public function transform($voiture)
    {
        // TODO: Implement transform() method.
        if($voiture === null){
            return null;
        }
        $modele = $voiture->getModele();
        var_dump("view(Transform) id=".$modele->getId()." nom=".$modele->getNom()."<br/>");
        return $voiture;
    }

    /**
     * Transforms a value from the transformed representation to its original
     * representation.
     *
     * This method is called when {@link Form::submit()} is called to transform the requests tainted data
     * into an acceptable format for your data processing/model layer.
     *
     * This method must be able to deal with empty values. Usually this will
     * be an empty string, but depending on your implementation other empty
     * values are possible as well (such as empty strings). The reasoning behind
     * this is that value transformers must be chainable. If the
     * reverseTransform() method of the first value transformer outputs an
     * empty string, the second value transformer must be able to process that
     * value.
     *
     * By convention, reverseTransform() should return NULL if an empty string
     * is passed.
     *
     * @param mixed $value The value in the transformed representation
     *
     * @return mixed The value in the original representation
     *
     * @throws TransformationFailedException When the transformation fails.
     */
    public function reverseTransform($voiture)
    {
        // TODO: Implement reverseTransform() method.
        if(!$voiture){
            return null;
        }
        $modele = $voiture->getModele();
        var_dump("view(reverseTransform) id=".$modele->getId()." nom=".$modele->getNom()."<br/>");
        $mod = $this->em->getRepository("JcJolieCarBundle:Modele")->find($modele->getId());
        var_dump("after view(reverseTransform) id=".$mod->getId()." nom=".$mod->getNom()."<br/>");
        if($modele===null){
            throw new TransformationFailedException(sprintf(
                    'Le numéro "%s" ne peut pas être trouvé!',
                    $voiture->getId()
                ));
        }
        return $voiture;

    }
}