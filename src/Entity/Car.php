<?php

namespace App\Entity;
use App\Entity\Keyword;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
     /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\OneToMany(targetEntity="Keyword",mappedBy="car",cascade ={"persist","remove"})
     */
    private $keywords;

    public function __construct(){
         $this->keywords = new ArrayCollection();
         $this->cities = new ArrayCollection();    
    }
   
    public function getKeywords()
    {
        return $this->keywords;
    }

    public function  addkeyword(Keyword $keyword){
     $this->keywords->add($keyword);
     $keyword->setCar($this); 
    }

    public function  removekeyword(Keyword $keyword){
        $this->keywords->removeElement($keyword);
       }

     /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(message="Le  nom ne peut pas étre vide")
     */
    protected $name;
   
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le modéle ne peut pas étre vide")
     * checkMX=true
     */
    // @Assert\Email(message="the email '{{ value }}' is not valid.",
    protected $model;

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }
    
    /**
     * @ORM\Column(type="integer")
     *  @Assert\NotBlank(message="Le champs prix ne peut pas étre vide")
     * @Assert\LessThan(value=10000,message="le prix doit etre inférieur a 10000")
     * @Assert\GreaterThan(value= 10 , message ="le prix doit etre supérieur  a 10")
     */
    protected $price;

    public function getprice(): ?int
    {
        return $this->price;
    }

    public function setprice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
     /**
     * @ORM\OneToOne(targetEntity="Image",cascade={"persist","remove"})
     */
    private $image;

    public function getImage(): ?Image
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;

    }
     /**
     * @ORM\ManyToMany(targetEntity="App\Entity\City", inversedBy="cars")
     */
    private $cities;

    /**
     * @return Collection|City[]
     */
    public function getCities(): Collection
    {
        return $this->cities;
    }

    public function addCity(City $city): self
    {
        if (!$this->cities->contains($city)) {
            $this->cities[] = $city;
             
        }

        return $this;
    }

    public function removeCity(City $city): self
    {
        if($this->cities->contains($city)){

            $this->cities->removeElement($city);
        }

        return $this;
    }



  



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;
    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
        /**
     * @ORM\Column(type="string", length=255)
     */
    private $fuel;

    public function getFuel(): ?string
    {
        return $this->fuel;
    }

    public function setFuel(string $fuel): self
    {
        $this->fuel = $fuel;
        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="cars")
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $description;
 
    public function getUser()
    {
        return $this->user;
    }

    
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
