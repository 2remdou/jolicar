<?php
/**
 * Created by PhpStorm.
 * User: mdoutoure
 * Date: 13/12/2014
 * Time: 10:53
 */
namespace Jc\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\Doctrine;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Jc\UserBundle\Entity\TypeUser;

class LoadTypeUserData extends AbstractFixture implements OrderedFixtureInterface {


    /**
     * Load data fixtures with the passed EntityManager
     */
    function load(ObjectManager $manager)
    {
        $listeTypeUser = array('Particulier','Parc');

        foreach ($listeTypeUser as $i => $typeUser) {
            $typeUsers[$i] = new TypeUser();
            $typeUsers[$i]->setNom($typeUser);
            $manager->persist($typeUsers[$i]);
            $this->addReference('typeUser'.$i, $typeUsers[$i]);
        }

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}