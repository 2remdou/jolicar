<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\Expose;
use Symfony\Component\Validator\Constraints as Assert;
use Jc\JolieCarBundle\Validator\Constraints as AssertJc;
use Jc\UserBundle\Entity\User;
use JMS\Serializer\Annotation\MaxDepth;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\VoitureRepository")
 * @ExclusionPolicy("all")
 */
class Voiture
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
     * @var integer
     *
     * @ORM\Column(name="prix", type="bigint")
     * @Assert\NotBlank(message="Veuillez fournir un prix de vente")
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un prix Valide")
     * @Expose
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="kmParcouru", type="integer",nullable=true)
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de Kilometre valide")
     * @Expose
     */
    private $kmParcouru;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateAcquisition", type="date",nullable=true)
     * @Assert\Date(message="Veuillez fournir une date valide")
     * @Expose
     */
    private $dateAcquisition;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreRoueMotrice", type="smallint",nullable=true)
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de roues valide")
     * @Expose
     */
    private $nombreRoueMotrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombrePorte", type="smallint",nullable=true)
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de portes valide")
     * @Expose
     */
    private $nombrePorte;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombreSiege", type="smallint",nullable=true)
     * @Assert\GreaterThan(value=0,message="Veuillez fournir un nombre de sieges valide")
     * @Expose
     */
    private $nombreSiege;
    
    /**
     * @ORM\ManyToOne(targetEntity="Modele", inversedBy="voitures")
     * @ORM\JoinColumn(nullable=false,referencedColumnName="id")
     * @Assert\Valid()
     * @Expose
     */
    private $modele;
    
    /**
     * @ORM\ManyToOne(targetEntity="Boitier", inversedBy="voitures")
     * @Assert\Valid()
     */
    private  $boitier;
    
    /**
     * @ORM\ManyToOne(targetEntity="Jc\UserBundle\Entity\User", inversedBy="voitures")
     * @Expose
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Carburant", inversedBy="voitures")
     * @Assert\Valid()
     */
    private $carburant;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="voiture",cascade={"persist","remove"})
     * @Assert\Valid()
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     */
    private $images;
    /**
     * @ORM\OneToOne(targetEntity="Image",cascade={"persist","remove"})
     * @Assert\Valid()
     * @ORM\JoinColumn(nullable=true)
     * @Expose
     */
    private $mainImage;
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
     * @param \Jc\JolieCarBundle\Entity\Boitier $boitier
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
     * @return \Jc\JolieCarBundle\Entity\Boitier
     */
    public function getBoitier()
    {
        return $this->boitier;
    }

    /**
     * Set user
     *
     * @param \Jc\UserBundle\Entity\User
     * @return Voiture
     */
    public function setUser(User $user = null)
    {
        //var_dump($user);
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Jc\JolieCarBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set carburant
     *
     * @param \Jc\JolieCarBundle\Entity\Carburant $carburant
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
     * @return \Jc\JolieCarBundle\Entity\Carburant
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
        $images = new ArrayCollection();
        foreach($this->images as $image){
            if(!$image->isMainImage())
                $images[] = $image;
        }
        return $images;
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

    /**
     * Set mainImage
     *
     * @param \Jc\JolieCarBundle\Entity\Image $mainImage
     * @return Voiture
     */
    public function setMainImage(\Jc\JolieCarBundle\Entity\Image $mainImage = null)
    {
        if($mainImage==null){
            return $this;
        }

        if($mainImage->getFile() != null){
            $this->mainImage = $mainImage;
            $this->mainImage->setVoiture($this);
            $this->mainImage->setMainImage(true);
        }

        return $this;
    }

    /**
     * Add images
     *
     * @param \Jc\JolieCarBundle\Entity\Image $images
     * @return Voiture
     */
    public function addImage(Image $images)
    {
        if($images->getFile() !== null && !$images->isMainImage()){
            $images->setVoiture($this);
            $images->setMainImage(false);
            $this->images[] = $images;
        }


        return $this;
    }

    /**
     * Get mainImage
     *
     * @return \Jc\JolieCarBundle\Entity\Image 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }
}
