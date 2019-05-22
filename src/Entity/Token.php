<?php

namespace App\Entity;


use App\Entity\User;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TokenRepository")
 */
class Token
{

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;
    public function __construct(User $user){
        $this->createdAt = new \DateTime();
        $this->user = $user;
        $this->value = md5(uniqid());
    }   
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $value;


    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(user $user): self
    {
        $this->user = $user;

        return $this;
    }
 
    public function isValid(){
        $interval = new \DateInterval('PT6H');

        return  new \DateTime() <= $this->createdAt->add($interval);
    }
}
