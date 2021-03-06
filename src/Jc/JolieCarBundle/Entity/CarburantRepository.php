<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CarburantRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CarburantRepository extends EntityRepository
{
    public function getHasard()
    {
        $carburants = $this->findAll();
        $max = count($carburants);
        return $carburants[rand(1, $max)];
    }
}
