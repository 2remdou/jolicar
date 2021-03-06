<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Proprietaire
 *
 * @ORM\Table(name="proprietaire")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ProprietaireRepository")
 */
class Proprietaire
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
     * @Assert\NotBlank(message="Veuillez fournir le nom du Proprietaire")
     */
    private $nom;
    
    /**
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="proprietaire")
     */
    private $voitures;
    
    /**
     * @ORM\OneToOne(targetEntity="Adresse")
     * @Assert\Valid()
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="TypeProprietaire",inversedBy="proprietaires")
     * @Assert\Valid()
     */
    private $typeProprietaire;
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
     * @return Proprietaire
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
     * @param \Jc\JolieCarBundle\Entity\Voiture $voiture
     * @return Proprietaire
     */
    public function addVoiture(Voiture $voiture)
    {
        $this->voiture[] = $voiture;

        return $this;
    }

    /**
     * Remove voiture
     *
     * @param \Jc\JolieCarBundle\Entity\Voiture $voiture
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
     * @param \Jc\JolieCarBundle\Entity\Adresse $adresse
     * @return Proprietaire
     */
    public function setAdresse(Adresse $adresse = null)
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
     * Get voitures
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVoitures()
    {
        return $this->voitures;
    }

    /**
     * Set typeProprietaire
     *
     * @param \Jc\JolieCarBundle\Entity\TypeProprietaire $typeProprietaire
     * @return Proprietaire
     */
    public function setTypeProprietaire(\Jc\JolieCarBundle\Entity\TypeProprietaire $typeProprietaire = null)
    {
        $this->typeProprietaire = $typeProprietaire;

        return $this;
    }

    /**
     * Get typeProprietaire
     *
     * @return \Jc\JolieCarBundle\Entity\TypeProprietaire 
     */
    public function getTypeProprietaire()
    {
        return $this->typeProprietaire;
    }
}
