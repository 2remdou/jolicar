<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Modele
 *
 * @ORM\Table(name="modele")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ModeleRepository")
 */
class Modele
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $nom;
    /**
     *@ORM\ManyToOne(targetEntity="Marque", inversedBy="modeles")
     *@ORM\JoinColumn(nullable=false)
     *@Assert\Valid()
     */
    private $marque;
    /**
     * @ORM\OneToMany(targetEntity="Voiture", mappedBy="modele")
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
     * @param \Jc\JolieCar\Entity\Marque $marque
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
     * @return \Jc\JolieCar\Entity\Marque 
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
