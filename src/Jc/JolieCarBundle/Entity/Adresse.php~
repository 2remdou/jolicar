<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Adresse
 *
 * @ORM\Table(name="adresse")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\AdresseRepository")
 */
class Adresse
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
     * @ORM\Column(name="telephone", type="string", length=12)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message="Veuillez fournir une adresse electronique valide")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=255)
     * @Assert\Url(message="Veuillez fournir un site valide")
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=255)
     */
    private $quartier;

    /**
     * @var string
     *
     * @ORM\Column(name="indicationLieu", type="text")
     */
    private $indicationLieu;


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
     * Set telephone
     *
     * @param string $telephone
     * @return Adresse
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Adresse
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set site
     *
     * @param string $site
     * @return Adresse
     */
    public function setSite($site)
    {
        $this->site = $site;

        return $this;
    }

    /**
     * Get site
     *
     * @return string 
     */
    public function getSite()
    {
        return $this->site;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     * @return Adresse
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string 
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set indicationLieu
     *
     * @param string $indicationLieu
     * @return Adresse
     */
    public function setIndicationLieu($indicationLieu)
    {
        $this->indicationLieu = $indicationLieu;

        return $this;
    }

    /**
     * Get indicationLieu
     *
     * @return string 
     */
    public function getIndicationLieu()
    {
        return $this->indicationLieu;
    }
}
