<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * proprietaireRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProprietaireRepository extends EntityRepository
{
      public function getHasard()
    {
        $proprietaire = $this->findAll();
        $max = count($proprietaire);
        return $proprietaire[rand(1, $max)];
    }
}