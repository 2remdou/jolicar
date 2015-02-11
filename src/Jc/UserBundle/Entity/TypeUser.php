<?php

namespace Jc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * TypeUser
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jc\UserBundle\Entity\TypeUserRepository")
 * @ExclusionPolicy("all")
 */
class TypeUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Expose
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity="Jc\UserBundle\Entity\User",mappedBy="typeUser")
     * @ORM\JoinColumn(nullable=true)
     */
    private $users;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return TypeUser
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add users
     *
     * @param \Jc\UserBundle\Entity\TypeUser $users
     * @return TypeUser
     */
    public function addUser(\Jc\UserBundle\Entity\TypeUser $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Jc\UserBundle\Entity\TypeUser $users
     */
    public function removeUser(\Jc\UserBundle\Entity\TypeUser $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
