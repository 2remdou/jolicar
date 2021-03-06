<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Exclude;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\ExclusionPolicy;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Modele
 *
 * @ORM\Table(name="modele")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ModeleRepository")
 * @ExclusionPolicy("all")
 *
 */
//@UniqueEntity(fields={"marque","nom"},message="Cette marque possède déja un modele de même nom")
class Modele
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Expose
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank(message="Veuillez fournir le nom du modele")
     * @Expose
     */
    private $nom;
    /**
     *@ORM\ManyToOne(targetEntity="Marque", inversedBy="modeles")
     *@Assert\Valid()
     * @Expose
     */
    private $marque;
    /**
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="modele")
     * @Exclude()
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
     * @return Modele
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
     * Set marque
     *
     * @param \Jc\JolieCarBundle\Entity\Marque $marque
     * @return Modele
     */
    public function setMarque(Marque $marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return \Jc\JolieCarBundle\Entity\Marque
     */
    public function getMarque()
    {
        return $this->marque;
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
     * @param \Jc\JolieCarBundle\Entity\Voiture $voitures
     * @return Modele
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

}
