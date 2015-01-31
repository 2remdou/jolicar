<?php

namespace Jc\JolieCarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\AccessType;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\SerializedName;

/**
 * Image
 * @ORM\Table(name="image")
 * @ORM\Entity(repositoryClass="Jc\JolieCarBundle\Entity\ImageRepository")
 * @ORM\HasLifecycleCallbacks
 * @ExclusionPolicy("all")
 * @AccessType("public_method")
 */
class Image
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
     * @ORM\ManyToOne(targetEntity="Voiture", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voiture;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     */
    private  $path;
    /**
     * @Assert\Image(maxSize="6000000")
     */
    private $file;

    /**
     * @ORM\Column(type="boolean",options={"default"=0})
     */
    private $mainImage=false;


    protected  function getAbsolutePath(){
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    /**
     * @VirtualProperty
     * @SerializedName("webPath")
     *
     */

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
        $file = $this->getAbsolutePath();
        if(file_exists($file)){
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
    public function setId($id){
        $this->id = $id;
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

    /**
     * Set mainImage
     *
     * @param boolean $mainImage
     * @return Image
     */
    public function setMainImage($mainImage)
    {
        $this->mainImage = $mainImage;

        return $this;
    }

    /**
     * Get mainImage
     *
     * @return boolean 
     */
    public function isMainImage()
    {
        return $this->mainImage;
    }

    /**
     * Get mainImage
     *
     * @return boolean 
     */
    public function getMainImage()
    {
        return $this->mainImage;
    }
}
