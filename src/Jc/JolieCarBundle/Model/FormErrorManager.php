<?php
/**
 * Created by PhpStorm.
 * User: delphinsagno
 * Date: 05/01/15
 * Time: 16:55
 */

namespace Jc\JolieCarBundle\Model;


use Symfony\Component\Form\FormErrorIterator;

class FormErrorManager {

    private $errorForm;

    public function __construct(FormErrorIterator $errorForm){
        $this->errorForm = $errorForm;
    }
    public function listError(){
        if(count($this->errorForm)<=0){
            return null;
        }
        $mesErreur = array();
        foreach($this->errorForm as $error){
            $mesErreur[] = 'Nature :'.$error->getCause().' : '.$error->getMessage();
        }
        $mesMessage = "<h5>".implode("<br/>",$mesErreur)."</h5>";
        return $mesMessage;
    }
} 