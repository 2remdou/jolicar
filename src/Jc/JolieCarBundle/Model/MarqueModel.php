<?php
//src/Jc/JolieCarbundle/Model/MarqueModel.php

namespace Jc\JolieCarBundle\Model;

use Doctrine\ORM\EntityManager;
class MarqueModel implements MarqueInterface
{
    protected $em;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function listMarque() {
        $list = $this->em->getRepository("JcJolieCarBundle:Marque")->findAll();
        
        return $list;
    }

}

