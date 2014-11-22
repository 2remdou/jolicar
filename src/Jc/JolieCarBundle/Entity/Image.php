<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Image
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\ManyToOne(targetEntity="Voiture", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;
    /**
     * @ORM\Column(name="enVedette", type="boolean")
     */
    private $enVedette;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private  $path;
    /**
     * @Assert\Image(maxSize="6000000")
     */
    private $file;

    protected  function getAbsolutePath(){
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    public   function getWebPath(){
        return null === $this->path ? null : $this->getUploadDir();
    }

    protected function getUploadDir(){
        return 'images/cars/';
    }
    protected  function getUploadRootDir(){
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    public function __construct() {
        $this->enVedette = false;
    }
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public  function preUpload()
    {
        if(null !== $this->file){
            $this->path = sha1(uniqid(mt_rand(),true)).'.'.$this->file->guessExtension();
            $this->nom = $this->file->getClientOriginalName();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload(){
        if(null === $this->file){
            return;
        }

        $this->file->move($this->getUploadRootDir(),$this->path);

        unset($this->file);

    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload(){
        if($file = $this->getAbsolutePath()){
            unlink($file);
        }
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

    /**
     * Set path
     *
     * @param string $path
     * @return Image
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
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
    public  function getFile(){
        return $this->file;
    }
    public function setFile(UploadedFile $file){
        $this->file = $file;
    }
}
