<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;
    private $file;
    
    /**
     * Get the value of file
     */ 
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the value of file
     *
     * @return  self
     */ 
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    private $path;
    /**
     * Get the value of path
     */ 
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return  self
     */ 
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    } 

    /**
     * @ORM\PreFlush()
     */
  public function handle() 
  {
        if($this->file === null  ){

            return;
        }

    if($this->id){  
        unlink($this->path.'/'.$this->name);
    }
  
  

  $name = $this->imageName();
  $this->setName($name);
  // deplacer le fichier
  $this->file->move($this->path,$name);
  
  }

  public function imageName() : string
  {
      return md5(uniqid()).'.'.$this->file->guessExtension();
      //  or  $this->file->getClientOriginalName();
  }
}
