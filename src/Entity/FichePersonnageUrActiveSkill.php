<?php

namespace App\Entity;

use App\Repository\FichePersonnageUrActiveSkillRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichePersonnageUrActiveSkillRepository::class)]
class FichePersonnageUrActiveSkill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\Column(type: 'string', length: 255)]
    private $aptitudeleader;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomattaquespecial;

    #[ORM\Column(type: 'text')]
    private $descriptionattaquespecial;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomaptitudepassive;

    #[ORM\Column(type: 'text')]
    private $descriptionaptitudepassive;

    #[ORM\Column(type: 'text')]
    private $activeskill;

    #[ORM\Column(type: 'text')]
    private $listedesliensdupersonnage;

    #[ORM\Column(type: 'text')]
    private $listedescategoriesdupersonage;

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

    #[ORM\ManyToOne(targetEntity: EncyclopedieDuPersonnage::class, inversedBy: 'fichePersonnageUrActiveSkills')]
    #[ORM\JoinColumn(nullable: false)]
    private $encyclopediedupersonnage;

    #[ORM\Column(type: 'text')]
    private $descriptionactiveskill;

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

    public function getAptitudeleader(): ?string
    {
        return $this->aptitudeleader;
    }

    public function setAptitudeleader(string $aptitudeleader): self
    {
        $this->aptitudeleader = $aptitudeleader;

        return $this;
    }

    public function getNomattaquespecial(): ?string
    {
        return $this->nomattaquespecial;
    }

    public function setNomattaquespecial(string $nomattaquespecial): self
    {
        $this->nomattaquespecial = $nomattaquespecial;

        return $this;
    }

    public function getDescriptionattaquespecial(): ?string
    {
        return $this->descriptionattaquespecial;
    }

    public function setDescriptionattaquespecial(string $descriptionattaquespecial): self
    {
        $this->descriptionattaquespecial = $descriptionattaquespecial;

        return $this;
    }

    public function getNomaptitudepassive(): ?string
    {
        return $this->nomaptitudepassive;
    }

    public function setNomaptitudepassive(string $nomaptitudepassive): self
    {
        $this->nomaptitudepassive = $nomaptitudepassive;

        return $this;
    }

    public function getDescriptionaptitudepassive(): ?string
    {
        return $this->descriptionaptitudepassive;
    }

    public function setDescriptionaptitudepassive(string $descriptionaptitudepassive): self
    {
        $this->descriptionaptitudepassive = $descriptionaptitudepassive;

        return $this;
    }

    public function getActiveskill(): ?string
    {
        return $this->activeskill;
    }

    public function setActiveskill(string $activeskill): self
    {
        $this->activeskill = $activeskill;

        return $this;
    }

    public function getListedesliensdupersonnage(): ?string
    {
        return $this->listedesliensdupersonnage;
    }

    public function setListedesliensdupersonnage(string $listedesliensdupersonnage): self
    {
        $this->listedesliensdupersonnage = $listedesliensdupersonnage;

        return $this;
    }

    public function getListedescategoriesdupersonage(): ?string
    {
        return $this->listedescategoriesdupersonage;
    }

    public function setListedescategoriesdupersonage(string $listedescategoriesdupersonage): self
    {
        $this->listedescategoriesdupersonage = $listedescategoriesdupersonage;

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

    public function getEncyclopediedupersonnage(): ?EncyclopedieDuPersonnage
    {
        return $this->encyclopediedupersonnage;
    }

    public function setEncyclopediedupersonnage(?EncyclopedieDuPersonnage $encyclopediedupersonnage): self
    {
        $this->encyclopediedupersonnage = $encyclopediedupersonnage;

        return $this;
    }

    public function getDescriptionactiveskill(): ?string
    {
        return $this->descriptionactiveskill;
    }

    public function setDescriptionactiveskill(string $descriptionactiveskill): self
    {
        $this->descriptionactiveskill = $descriptionactiveskill;

        return $this;
    }
}
