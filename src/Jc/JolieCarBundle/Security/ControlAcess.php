<?php
/**
 * Created by PhpStorm.
 * User: Toure
 * Date: 05/01/15
 * Time: 21:13
 */

namespace Jc\JolieCarBundle\Security;

use Doctrine\ORM\EntityManager;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Security\Core\SecurityContextInterface;


/**
 * Class RequestAccessEvaluator
 * @package Jc\JolieCarBundle\Security
 * @DI\Service
 */
class ControlAccess {

    private $securityContext;
    private $em;

    /**
     * @param SecurityContextInterface $securityContext
     * @DI\InjectParams({
     *      "securityContext" = @DI\Inject("security.context"),
     *      "em" = @DI\Inject("doctrine.orm.enity_manager")
     * })
     */
    public function __construct(SecurityContextInterface $securityContext, EntityManager $em){
        $this->securityContext = $securityContext;
        $this->em = $em;
    }

    /**
     * @DI\SecurityFunction("isAuthorizeUpdateCar")
     */
    public function isAuthorizeUpdateCar($idCar){
        $user = $this->securityContext->getToken()->getUser();
        $car = $this->em->getRepository('JcJolieCarBundle:Voiture')->find($idCar);
        if($user === null || $car === null){
            return false;
        }
        var_dump("pourquoi ".$user == $car->getUser());
        return $user == $car->getUser();
    }
} 