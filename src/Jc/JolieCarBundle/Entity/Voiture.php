<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Jc\JolieCarBundle\Validator\Constraints as AssertJc;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\VoitureRepository")
 */
class Voiture
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
     * @var integer
     *
     * @ORM\Column(name="prix", type="bigint")
     * @Assert\NotBlank(message="Veuillez fournir un prix de vente")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un prix Valide")
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="kmParcouru", type="integer")
     * @Assert\Type(type="integer",message="Veuillez fournir un nombre de Kilometre valide")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de Kilometre valide")
     */
    private $kmParcouru;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAcquisition", type="date")
     * @Assert\Date(message="Veuillez fournir une date valide")
     * @AssertJc\ConstraintDate()
     */
    private $dateAcquisition;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreRoueMotrice", type="smallint")
     * @Assert\Type(type="integer",message="Veuillez fournir un nombre de roues valide")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de roues valide")
     */
    private $nombreRoueMotrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombrePorte", type="smallint")
     * @Assert\Type(type="integer",message="Veuillez fournir un nombre de portes valide")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de portes valide")
     */
    private $nombrePorte;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreSiege", type="smallint")
     * @Assert\Type(type="integer",message="Veuillez fournir un nombre de sieges valide")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de sieges valide")
     */
    private $nombreSiege;
    
    /**
     * @ORM\ManyToOne(targetEntity="Modele", inversedBy="voitures")
     * @Assert\Valid()
     */
    private $modele;
    
    /**
     * @ORM\ManyToOne(targetEntity="Boitier", inversedBy="voitures")
     * @Assert\Valid()
     */
    private  $boitier;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parc", inversedBy="voitures")
     * @Assert\Valid()
     */
    private $parc;
    
    /**
     * @ORM\ManyToOne(targetEntity="Carburant", inversedBy="voitures")
     * @Assert\Valid()
     */
    private $carburant;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="voiture")
     * @Assert\Valid()
     */
    private $images;
    /**
     * @ORM\Column(name="top", type="boolean")
     */
    private $top;
    /**
     * @ORM\Column(name="newCar", type="boolean")
     */
    private $newCar;
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     * @return Voiture
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer 
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set kmParcouru
     *
     * @param integer $kmParcouru
     * @return Voiture
     */
    public function setKmParcouru($kmParcouru)
    {
        $this->kmParcouru = $kmParcouru;

        return $this;
    }

    /**
     * Get kmParcouru
     *
     * @return integer 
     */
    public function getKmParcouru()
    {
        return $this->kmParcouru;
    }

    /**
     * Set dateAcquisition
     *
     * @param \DateTime $dateAcquisition
     * @return Voiture
     */
    public function setDateAcquisition($dateAcquisition)
    {
        $this->dateAcquisition = $dateAcquisition;

        return $this;
    }

    /**
     * Get dateAcquisition
     *
     * @return \DateTime 
     */
    public function getDateAcquisition()
    {
        return $this->dateAcquisition;
    }

    /**
     * Set nombreRoueMotrice
     *
     * @param integer $nombreRoueMotrice
     * @return Voiture
     */
    public function setNombreRoueMotrice($nombreRoueMotrice)
    {
        $this->nombreRoueMotrice = $nombreRoueMotrice;

        return $this;
    }

    /**
     * Get nombreRoueMotrice
     *
     * @return integer 
     */
    public function getNombreRoueMotrice()
    {
        return $this->nombreRoueMotrice;
    }

    /**
     * Set nombrePorte
     *
     * @param integer $nombrePorte
     * @return Voiture
     */
    public function setNombrePorte($nombrePorte)
    {
        $this->nombrePorte = $nombrePorte;

        return $this;
    }

    /**
     * Get nombrePorte
     *
     * @return integer 
     */
    public function getNombrePorte()
    {
        return $this->nombrePorte;
    }

    /**
     * Set nombreSiege
     *
     * @param integer $nombreSiege
     * @return Voiture
     */
    public function setNombreSiege($nombreSiege)
    {
        $this->nombreSiege = $nombreSiege;

        return $this;
    }

    /**
     * Get nombreSiege
     *
     * @return integer 
     */
    public function getNombreSiege()
    {
        return $this->nombreSiege;
    }

    
    /**
     * Set boitier
     *
     * @param \Jc\JolieCar\Entity\Boitier $boitier
     * @return Voiture
     */
    public function setBoitier(Boitier $boitier = null)
    {
        $this->boitier = $boitier;

        return $this;
    }

    /**
     * Get boitier
     *
     * @return \Jc\JolieCar\Entity\Boitier 
     */
    public function getBoitier()
    {
        return $this->boitier;
    }

    /**
     * Set parc
     *
     * @param \Jc\JolieCar\Entity\Parc $parc
     * @return Voiture
     */
    public function setParc(Parc $parc = null)
    {
        $this->parc = $parc;

        return $this;
    }

    /**
     * Get parc
     *
     * @return \Jc\JolieCar\Entity\Parc 
     */
    public function getParc()
    {
        return $this->parc;
    }

    /**
     * Set carburant
     *
     * @param \Jc\JolieCar\Entity\Carburant $carburant
     * @return Voiture
     */
    public function setCarburant(Carburant $carburant = null)
    {
        $this->carburant = $carburant;

        return $this;
    }

    /**
     * Get carburant
     *
     * @return \Jc\JolieCar\Entity\Carburant 
     */
    public function getCarburant()
    {
        return $this->carburant;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        $this->top = true;
        $this->newCar =false;
    }

    /**
     * Add images
     *
     * @param \Jc\JolieCarBundle\Entity\Image $images
     * @return Voiture
     */
    public function addImage(Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \Jc\JolieCarBundle\Entity\Image $images
     */
    public function removeImage(Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set modele
     *
     * @param \Jc\JolieCarBundle\Entity\Modele $modele
     * @return Voiture
     */
    public function setModele(Modele $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \Jc\JolieCarBundle\Entity\Modele 
     */
    public function getModele()
    {
        return $this->modele;
    }



    /**
     * Set top
     *
     * @param boolean $top
     * @return Voiture
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * Get top
     *
     * @return boolean 
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Set newCar
     *
     * @param boolean $newCar
     * @return Voiture
     */
    public function setNewCar($newCar)
    {
        $this->newCar = $newCar;

        return $this;
    }

    /**
     * Get newCar
     *
     * @return boolean 
     */
    public function getNewCar()
    {
        return $this->newCar;
    }
}
