<?php

namespace App\Entity;

use App\Repository\EncyclopedieDuPersonnageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncyclopedieDuPersonnageRepository::class)]
class EncyclopedieDuPersonnage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\ManyToOne(targetEntity: EncyclopedieDesPersonnages::class, inversedBy: 'encyclopediedupersonnage')]
    #[ORM\JoinColumn(nullable: false)]
    private $encyclopedieDesPersonnages;

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnageSsr::class, orphanRemoval: true)]
    private $fichePersonnageSsrs;

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnageUr::class, orphanRemoval: true)]
    private $fichePersonnageUrs;

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnageLr::class, orphanRemoval: true)]
    private $fichePersonnageLrs;

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnageUrActiveSkill::class, orphanRemoval: true)]
    private $fichePersonnageUrActiveSkills;

    public function __construct()
    {
        $this->fichePersonnageSsrs = new ArrayCollection();
        $this->fichePersonnageUrs = new ArrayCollection();
        $this->fichePersonnageLrs = new ArrayCollection();
        $this->fichePersonnageUrActiveSkills = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
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

    public function getEncyclopedieDesPersonnages(): ?EncyclopedieDesPersonnages
    {
        return $this->encyclopedieDesPersonnages;
    }

    public function setEncyclopedieDesPersonnages(?EncyclopedieDesPersonnages $encyclopedieDesPersonnages): self
    {
        $this->encyclopedieDesPersonnages = $encyclopedieDesPersonnages;

        return $this;
    }

    /**
     * @return Collection|FichePersonnageSsr[]
     */
    public function getFichePersonnageSsrs(): Collection
    {
        return $this->fichePersonnageSsrs;
    }

    public function addFichePersonnageSsr(FichePersonnageSsr $fichePersonnageSsr): self
    {
        if (!$this->fichePersonnageSsrs->contains($fichePersonnageSsr)) {
            $this->fichePersonnageSsrs[] = $fichePersonnageSsr;
            $fichePersonnageSsr->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnageSsr(FichePersonnageSsr $fichePersonnageSsr): self
    {
        if ($this->fichePersonnageSsrs->removeElement($fichePersonnageSsr)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnageSsr->getEncyclopediedupersonnage() === $this) {
                $fichePersonnageSsr->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FichePersonnageUr[]
     */
    public function getFichePersonnageUrs(): Collection
    {
        return $this->fichePersonnageUrs;
    }

    public function addFichePersonnageUr(FichePersonnageUr $fichePersonnageUr): self
    {
        if (!$this->fichePersonnageUrs->contains($fichePersonnageUr)) {
            $this->fichePersonnageUrs[] = $fichePersonnageUr;
            $fichePersonnageUr->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnageUr(FichePersonnageUr $fichePersonnageUr): self
    {
        if ($this->fichePersonnageUrs->removeElement($fichePersonnageUr)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnageUr->getEncyclopediedupersonnage() === $this) {
                $fichePersonnageUr->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FichePersonnageLr[]
     */
    public function getFichePersonnageLrs(): Collection
    {
        return $this->fichePersonnageLrs;
    }

    public function addFichePersonnageLr(FichePersonnageLr $fichePersonnageLr): self
    {
        if (!$this->fichePersonnageLrs->contains($fichePersonnageLr)) {
            $this->fichePersonnageLrs[] = $fichePersonnageLr;
            $fichePersonnageLr->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnageLr(FichePersonnageLr $fichePersonnageLr): self
    {
        if ($this->fichePersonnageLrs->removeElement($fichePersonnageLr)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnageLr->getEncyclopediedupersonnage() === $this) {
                $fichePersonnageLr->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|FichePersonnageUrActiveSkill[]
     */
    public function getFichePersonnageUrActiveSkills(): Collection
    {
        return $this->fichePersonnageUrActiveSkills;
    }

    public function addFichePersonnageUrActiveSkill(FichePersonnageUrActiveSkill $fichePersonnageUrActiveSkill): self
    {
        if (!$this->fichePersonnageUrActiveSkills->contains($fichePersonnageUrActiveSkill)) {
            $this->fichePersonnageUrActiveSkills[] = $fichePersonnageUrActiveSkill;
            $fichePersonnageUrActiveSkill->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnageUrActiveSkill(FichePersonnageUrActiveSkill $fichePersonnageUrActiveSkill): self
    {
        if ($this->fichePersonnageUrActiveSkills->removeElement($fichePersonnageUrActiveSkill)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnageUrActiveSkill->getEncyclopediedupersonnage() === $this) {
                $fichePersonnageUrActiveSkill->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    } 
}
