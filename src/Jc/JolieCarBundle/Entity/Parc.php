<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parc
 *
 * @ORM\Table(name="parc")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ParcRepository")
 */
class Parc
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
     */
    private $nom;
    
    /**
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="parc")
     */
    private $voitures;
    
    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     */
    private $adresse;

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
     * @return Parc
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
        $this->voiture = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add voiture
     *
     * @param \Jc\JolieCar\Entity\Voiture $voiture
     * @return Parc
     */
    public function addVoiture(Voiture $voiture)
    {
        $this->voiture[] = $voiture;

        return $this;
    }

    /**
     * Remove voiture
     *
     * @param \Jc\JolieCar\Entity\Voiture $voiture
     */
    public function removeVoiture(Voiture $voiture)
    {
        $this->voiture->removeElement($voiture);
    }

    /**
     * Get voiture
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set adresse
     *
     * @param \Jc\JolieCar\Entity\Adresse $adresse
     * @return Parc
     */
    public function setAdresse(Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \Jc\JolieCar\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
