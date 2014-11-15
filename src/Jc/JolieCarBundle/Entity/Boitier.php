<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Boitier
 *
 * @ORM\Table(name="boitier")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\BoitierRepository")
 */
class Boitier
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir le nom du boitier")
     */
    private $nom;
    
    /**
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="boitier")
     * @ORM\JoinColumn(nullable=true)
     */
    private $voitures;
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
     * @return Boitier
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
        $this->voitures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add voitures
     *
     * @param \Jc\JolieCar\Entity\Voiture $voitures
     * @return Boitier
     */
    public function addVoiture(Voiture $voitures)
    {
        $this->voitures[] = $voitures;

        return $this;
    }

    /**
     * Remove voitures
     *
     * @param \Jc\JolieCar\Entity\Voiture $voitures
     */
    public function removeVoiture(Voiture $voitures)
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
}
