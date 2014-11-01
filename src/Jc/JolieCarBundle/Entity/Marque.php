<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Exclude;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\MarqueRepository")
 * @UniqueEntity("nom",message="Cette marque existe déja")
 *
 */
class Marque
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
     * @Assert\NotBlank()
     */
    private $nom;
    /**
     *@ORM\OneToMany(targetEntity="Modele", mappedBy="marque", cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=true)
     * @Exclude()
     */
    private $modeles;
    
    
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
     * @return Marque
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
        $this->modeles = new \Doctrine\Common\Collections\ArrayCollection();
        $this->voitures = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modeles
     *
     * @param Modele $modeles
     * @return Marque
     */
    public function addModele(Modele $modeles)
    {
        $this->modeles[] = $modeles;
        $modeles->setMarque($this);

        return $this;
    }

    /**
     * Remove modeles
     *
     * @param \Jc\JolieCar\Entity\Modele $modeles
     */
    public function removeModele(Modele $modeles)
    {
        $this->modeles->removeElement($modeles);
    }

    /**
     * Get modeles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getModeles()
    {
        return $this->modeles;
    }

}
