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

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnage::class, orphanRemoval: true)]
    private $fichePersonnages;

    public function __construct()
    {
        $this->fichePersonnageSsrs = new ArrayCollection();
        $this->fichePersonnageUrs = new ArrayCollection();
        $this->fichePersonnageLrs = new ArrayCollection();
        $this->fichePersonnageUrActiveSkills = new ArrayCollection();
        $this->fichePersonnages = new ArrayCollection();
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
     * @return Collection|FichePersonnage[]
     */
    public function getFichePersonnages(): Collection
    {
        return $this->fichePersonnages;
    }

    public function addFichePersonnage(FichePersonnage $fichePersonnage): self
    {
        if (!$this->fichePersonnages->contains($fichePersonnage)) {
            $this->fichePersonnages[] = $fichePersonnage;
            $fichePersonnage->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnage(FichePersonnage $fichePersonnage): self
    {
        if ($this->fichePersonnages->removeElement($fichePersonnage)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnage->getEncyclopediedupersonnage() === $this) {
                $fichePersonnage->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    } 
}
