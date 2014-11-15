<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 15/11/14
 * Time: 07:40
 */

namespace Jc\JolieCarBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ConstraintDateValidator extends ConstraintValidator {

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     *
     * @api
     */
    public function validate($value, Constraint $constraint)
    {
        if($value>new \DateTime()){
            $this->context->addViolation($constraint->message,array('%string'=> $value));
        }
    }
}