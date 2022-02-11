<?php

namespace App\Entity;

use App\Repository\FichePersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FichePersonnageRepository::class)]
class FichePersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\Column(type: 'text')]
    private $aptitudeleader;

    #[ORM\Column(type: 'string', length: 255)]
    private $nomattaquespecial;

    #[ORM\Column(type: 'text')]
    private $descriptionattaquespecial;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomattaquespecialultime;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descriptionattaquespecialultime;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomunitsuperattaque;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descriptionunitsuperattaque;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $nomactiveskill;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descriptionactiveskill;

    #[ORM\Column(type: 'string', length: 255)]
    private $nompassiveskill;

    #[ORM\Column(type: 'text')]
    private $descriptionpassiveskill;

    #[ORM\Column(type: 'text')]
    private $listedesliensdupersonnage;

    #[ORM\Column(type: 'text')]
    private $listedescategoriedupersonnage;

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

    #[ORM\ManyToOne(targetEntity: EncyclopedieDuPersonnage::class, inversedBy: 'fichePersonnages')]
    #[ORM\JoinColumn(nullable: false)]
    private $encyclopediedupersonnage;

    #[ORM\OneToMany(mappedBy: 'fichepersonnage', targetEntity: FrontPageNouveauPerso::class, orphanRemoval: true)]
    private $frontPageNouveauPersos;

    public function __construct()
    {
        $this->frontPageNouveauPersos = new ArrayCollection();
    }

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

    public function getNomattaquespecialultime(): ?string
    {
        return $this->nomattaquespecialultime;
    }

    public function setNomattaquespecialultime(?string $nomattaquespecialultime): self
    {
        $this->nomattaquespecialultime = $nomattaquespecialultime;

        return $this;
    }

    public function getDescriptionattaquespecialultime(): ?string
    {
        return $this->descriptionattaquespecialultime;
    }

    public function setDescriptionattaquespecialultime(?string $descriptionattaquespecialultime): self
    {
        $this->descriptionattaquespecialultime = $descriptionattaquespecialultime;

        return $this;
    }

    public function getNomunitsuperattaque(): ?string
    {
        return $this->nomunitsuperattaque;
    }

    public function setNomunitsuperattaque(?string $nomunitsuperattaque): self
    {
        $this->nomunitsuperattaque = $nomunitsuperattaque;

        return $this;
    }

    public function getDescriptionunitsuperattaque(): ?string
    {
        return $this->descriptionunitsuperattaque;
    }

    public function setDescriptionunitsuperattaque(?string $descriptionunitsuperattaque): self
    {
        $this->descriptionunitsuperattaque = $descriptionunitsuperattaque;

        return $this;
    }

    public function getNomactiveskill(): ?string
    {
        return $this->nomactiveskill;
    }

    public function setNomactiveskill(?string $nomactiveskill): self
    {
        $this->nomactiveskill = $nomactiveskill;

        return $this;
    }

    public function getDescriptionactiveskill(): ?string
    {
        return $this->descriptionactiveskill;
    }

    public function setDescriptionactiveskill(?string $descriptionactiveskill): self
    {
        $this->descriptionactiveskill = $descriptionactiveskill;

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

    public function getListedesliensdupersonnage(): ?string
    {
        return $this->listedesliensdupersonnage;
    }

    public function setListedesliensdupersonnage(string $listedesliensdupersonnage): self
    {
        $this->listedesliensdupersonnage = $listedesliensdupersonnage;

        return $this;
    }

    public function getListedescategoriedupersonnage(): ?string
    {
        return $this->listedescategoriedupersonnage;
    }

    public function setListedescategoriedupersonnage(string $listedescategoriedupersonnage): self
    {
        $this->listedescategoriedupersonnage = $listedescategoriedupersonnage;

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

    /**
     * @return Collection|FrontPageNouveauPerso[]
     */
    public function getFrontPageNouveauPersos(): Collection
    {
        return $this->frontPageNouveauPersos;
    }

    public function addFrontPageNouveauPerso(FrontPageNouveauPerso $frontPageNouveauPerso): self
    {
        if (!$this->frontPageNouveauPersos->contains($frontPageNouveauPerso)) {
            $this->frontPageNouveauPersos[] = $frontPageNouveauPerso;
            $frontPageNouveauPerso->setFichepersonnage($this);
        }

        return $this;
    }

    public function removeFrontPageNouveauPerso(FrontPageNouveauPerso $frontPageNouveauPerso): self
    {
        if ($this->frontPageNouveauPersos->removeElement($frontPageNouveauPerso)) {
            // set the owning side to null (unless already changed)
            if ($frontPageNouveauPerso->getFichepersonnage() === $this) {
                $frontPageNouveauPerso->setFichepersonnage(null);
            }
        }

        return $this;
    }
}
