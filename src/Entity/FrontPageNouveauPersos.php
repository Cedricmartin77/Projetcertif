<?php

namespace App\Entity;

use App\Repository\FrontPageNouveauPersosRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrontPageNouveauPersosRepository::class)]
class FrontPageNouveauPersos
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $img1;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img2;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img3;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img4;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img5;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $img6;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg1(): ?string
    {
        return $this->img1;
    }

    public function setImg1(string $img1): self
    {
        $this->img1 = $img1;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): self
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): self
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

    public function setImg4(?string $img4): self
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getImg5(): ?string
    {
        return $this->img5;
    }

    public function setImg5(?string $img5): self
    {
        $this->img5 = $img5;

        return $this;
    }

    public function getImg6(): ?string
    {
        return $this->img6;
    }

    public function setImg6(?string $img6): self
    {
        $this->img6 = $img6;

        return $this;
    }
}
