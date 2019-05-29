<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CalcRepository")
 */
class Calc
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="bigint")
     */
    private $a;

    /**
     * @ORM\Column(type="bigint")
     */
    private $b;

    /**
     * @ORM\Column(type="bigint")
     */
    private $res;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getA(): ?int
    {
        return $this->a;
    }

    public function setA(int $a): self
    {
        $this->a = $a;

        return $this;
    }

    public function getB(): ?int
    {
        return $this->b;
    }

    public function setB(int $b): self
    {
        $this->b = $b;

        return $this;
    }

    public function getRes(): ?int
    {
        return $this->res;
    }

    public function setRes(int $res): self
    {
        $this->res = $res;

        return $this;
    }
}
