<?php

namespace Jc\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Exclude;

/**
 * User
 *
 * @ORM\Table(name="mon_user")
 * @ORM\Entity(repositoryClass="Jc\UserBundle\Entity\UserRepository")
 * ExclusionPolicy("all")
 */
class User extends BaseUser
{
    public function __construct() {
        parent::__construct();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,options={"default"="unknown"})
     * @Assert\NotBlank(message="Veuillez fournir le nom du Proprietaire")
     * @Expose
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="autreNom", type="string", length=255,nullable=true)
     * @Expose
     */
    private $autreNom;

    /**
     * @ORM\OneToMany(targetEntity="Jc\JolieCarBundle\Entity\Voiture", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     * @Exclude
     */
    private $voitures;

    /**
     * @ORM\ManyToOne(targetEntity="Jc\JolieCarBundle\Entity\Adresse",inversedBy="users",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Assert\Valid()
     * @Expose
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="Jc\UserBundle\Entity\TypeUser",inversedBy="users")
     * @Assert\Valid()
     * @Expose()
     */
    private $typeUser;
    /**
     * Get id
     *
     * @return integer
     */


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
     * @return User
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
     * Add voitures
     *
     * @param \Jc\JolieCarBundle\Entity\Voiture $voitures
     * @return User
     */
    public function addVoiture(\Jc\JolieCarBundle\Entity\Voiture $voitures)
    {
        $this->voitures[] = $voitures;

        return $this;
    }

    /**
     * Remove voitures
     *
     * @param \Jc\JolieCarBundle\Entity\Voiture $voitures
     */
    public function removeVoiture(\Jc\JolieCarBundle\Entity\Voiture $voitures)
    {
        $this->voitures->removeElement($voitures);
    }

    /**
     * Get voitures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoitures()
    {
        return $this->voitures;
    }

    /**
     * Set adresse
     *
     * @param \Jc\JolieCarBundle\Entity\Adresse $adresse
     * @return User
     */
    public function setAdresse(\Jc\JolieCarBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \Jc\JolieCarBundle\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set typeUser
     *
     * @param \Jc\UserBundle\Entity\TypeUser $typeUser
     * @return User
     */
    public function setTypeUser(\Jc\UserBundle\Entity\TypeUser $typeUser = null)
    {
        $this->typeUser = $typeUser;

        return $this;
    }

    /**
     * Get typeUser
     *
     * @return \Jc\UserBundle\Entity\TypeUser 
     */
    public function getTypeUser()
    {
        return $this->typeUser;
    }

    /**
     * Set autreNom
     *
     * @param string $autreNom
     * @return User
     */
    public function setAutreNom($autreNom)
    {
        $this->autreNom = $autreNom;

        return $this;
    }

    /**
     * Get autreNom
     *
     * @return string 
     */
    public function getAutreNom()
    {
        return $this->autreNom;
    }
}
