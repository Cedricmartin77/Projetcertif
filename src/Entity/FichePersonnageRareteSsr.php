<?php

namespace App\Entity;

use App\Repository\FichePersonnageRareteSsrRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichePersonnageRareteSsrRepository::class)]
class FichePersonnageRareteSsr
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\Column(type: 'text')]
    private $descriptionleaderskill;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomsuperattaque;

    #[ORM\Column(type: 'text')]
    private $descriptionsuperattaque;

    #[ORM\Column(type: 'string', length: 255)]
    private $nompassiveskill;

    #[ORM\Column(type: 'text')]
    private $descriptionpassiveskill;

    #[ORM\Column(type: 'text')]
    private $listedesliensdupersonnages;

    #[ORM\Column(type: 'text')]
    private $listesdescategoriesdupersonnage;

    #[ORM\Column(type: 'integer')]
    private $hpdebase;

    #[ORM\Column(type: 'integer')]
    private $attaquedebase;

    #[ORM\Column(type: 'integer')]
    private $defensedebase;

    #[ORM\Column(type: 'integer')]
    private $hpmax;

    #[ORM\Column(type: 'integer')]
    private $attaquemax;

    #[ORM\Column(type: 'integer')]
    private $defensemax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getDescriptionleaderskill(): ?string
    {
        return $this->descriptionleaderskill;
    }

    public function setDescriptionleaderskill(string $descriptionleaderskill): self
    {
        $this->descriptionleaderskill = $descriptionleaderskill;

        return $this;
    }

    public function getNomsuperattaque(): ?string
    {
        return $this->nomsuperattaque;
    }

    public function setNomsuperattaque(string $nomsuperattaque): self
    {
        $this->nomsuperattaque = $nomsuperattaque;

        return $this;
    }

    public function getDescriptionsuperattaque(): ?string
    {
        return $this->descriptionsuperattaque;
    }

    public function setDescriptionsuperattaque(string $descriptionsuperattaque): self
    {
        $this->descriptionsuperattaque = $descriptionsuperattaque;

        return $this;
    }

    public function getNompassiveskill(): ?string
    {
        return $this->nompassiveskill;
    }

    public function setNompassiveskill(string $nompassiveskill): self
    {
        $this->nompassiveskill = $nompassiveskill;

        return $this;
    }

    public function getDescriptionpassiveskill(): ?string
    {
        return $this->descriptionpassiveskill;
    }

    public function setDescriptionpassiveskill(string $descriptionpassiveskill): self
    {
        $this->descriptionpassiveskill = $descriptionpassiveskill;

        return $this;
    }

    public function getListedesliensdupersonnages(): ?string
    {
        return $this->listedesliensdupersonnages;
    }

    public function setListedesliensdupersonnages(string $listedesliensdupersonnages): self
    {
        $this->listedesliensdupersonnages = $listedesliensdupersonnages;

        return $this;
    }

    public function getListesdescategoriesdupersonnage(): ?string
    {
        return $this->listesdescategoriesdupersonnage;
    }

    public function setListesdescategoriesdupersonnage(string $listesdescategoriesdupersonnage): self
    {
        $this->listesdescategoriesdupersonnage = $listesdescategoriesdupersonnage;

        return $this;
    }

    public function getHpdebase(): ?int
    {
        return $this->hpdebase;
    }

    public function setHpdebase(int $hpdebase): self
    {
        $this->hpdebase = $hpdebase;

        return $this;
    }

    public function getAttaquedebase(): ?int
    {
        return $this->attaquedebase;
    }

    public function setAttaquedebase(int $attaquedebase): self
    {
        $this->attaquedebase = $attaquedebase;

        return $this;
    }

    public function getDefensedebase(): ?int
    {
        return $this->defensedebase;
    }

    public function setDefensedebase(int $defensedebase): self
    {
        $this->defensedebase = $defensedebase;

        return $this;
    }

    public function getHpmax(): ?int
    {
        return $this->hpmax;
    }

    public function setHpmax(int $hpmax): self
    {
        $this->hpmax = $hpmax;

        return $this;
    }

    public function getAttaquemax(): ?int
    {
        return $this->attaquemax;
    }

    public function setAttaquemax(int $attaquemax): self
    {
        $this->attaquemax = $attaquemax;

        return $this;
    }

    public function getDefensemax(): ?int
    {
        return $this->defensemax;
    }

    public function setDefensemax(int $defensemax): self
    {
        $this->defensemax = $defensemax;

        return $this;
    }
}
