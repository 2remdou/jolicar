<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Image
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ImageRepository")
 * @UniqueEntity(fields={"voiture","enVedette"}, message="La voiture ne peut avoir qu'une seule photo en vedette")
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="Voiture", inversedBy="images")
     */
    private $voiture;
    /**
     * @ORM\Column(name="enVedette", type="boolean")
     */
    private $enVedette;
    
    
    public function __construct() {
        $this->enVedette = false;
    }

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
     * @return Image
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
     * Set voiture
     *
     * @param \Jc\JolieCarBundle\Entity\Voiture $voiture
     * @return Image
     */
    public function setVoiture(\Jc\JolieCarBundle\Entity\Voiture $voiture = null)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return \Jc\JolieCarBundle\Entity\Voiture 
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set enVedette
     *
     * @param boolean $enVedette
     * @return Image
     */
    public function setEnVedette($enVedette)
    {
        $this->enVedette = $enVedette;

        return $this;
    }

    /**
     * Get enVedette
     *
     * @return boolean 
     */
    public function getEnVedette()
    {
        return $this->enVedette;
    }
}
