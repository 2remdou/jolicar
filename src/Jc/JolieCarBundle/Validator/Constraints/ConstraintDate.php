<?php
/**
 * Created by PhpStorm.
 * User: Toure
 * Date: 15/11/14
 * Time: 07:32
 */
namespace Jc\JolieCarBundle\Validator\Constraints;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @package Jc\JolieCarBundle\Validator\Constraints
 */
class ConstraintDate extends Constraint{

    public $message = "La date '%date%' est postenieur à ajourd'hui";
} 