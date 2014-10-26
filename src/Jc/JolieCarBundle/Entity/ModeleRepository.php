<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ModeleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ModeleRepository extends EntityRepository
{
    public function getMarque()
    {
        $q = $this->createQueryBuilder('m')
                   ->leftJoin('m.marque', 'marque')
                   ->addSelect('marque')
                   ->getQuery();
        return $q->getArrayResult();
    }
}
