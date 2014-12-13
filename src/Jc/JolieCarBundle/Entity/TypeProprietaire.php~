<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeProprietaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\TypeProprietaireRepository")
 */
class TypeProprietaire
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
     * @ORM\Column(name="libelleTypeProprietaire", type="string", length=255)
     */
    private $libelleTypeProprietaire;

    /**
     * @ORM\OneToMany(targetEntity="Proprietaire",mappedBy="typeProprietaire")
     */
    private $proprietaires;

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
     * Set libelleTypeProprietaire
     *
     * @param string $libelleTypeProprietaire
     * @return TypeProprietaire
     */
    public function setLibelleTypeProprietaire($libelleTypeProprietaire)
    {
        $this->libelleTypeProprietaire = $libelleTypeProprietaire;

        return $this;
    }

    /**
     * Get libelleTypeProprietaire
     *
     * @return string 
     */
    public function getLibelleTypeProprietaire()
    {
        return $this->libelleTypeProprietaire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->proprietaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add proprietaires
     *
     * @param \Jc\JolieCarBundle\Entity\Proprietaire $proprietaires
     * @return TypeProprietaire
     */
    public function addProprietaire(\Jc\JolieCarBundle\Entity\Proprietaire $proprietaires)
    {
        $this->proprietaires[] = $proprietaires;

        return $this;
    }

    /**
     * Remove proprietaires
     *
     * @param \Jc\JolieCarBundle\Entity\Proprietaire $proprietaires
     */
    public function removeProprietaire(\Jc\JolieCarBundle\Entity\Proprietaire $proprietaires)
    {
        $this->proprietaires->removeElement($proprietaires);
    }

    /**
     * Get proprietaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProprietaires()
    {
        return $this->proprietaires;
    }
}
