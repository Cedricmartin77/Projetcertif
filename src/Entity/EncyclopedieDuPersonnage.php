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

    #[ORM\OneToMany(mappedBy: 'encyclopediedupersonnage', targetEntity: FichePersonnageRareteSsr::class)]
    private $fichePersonnageRareteSsrs;

    public function __construct()
    {
        $this->fichePersonnageRareteSsrs = new ArrayCollection();
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
     * @return Collection|FichePersonnageRareteSsr[]
     */
    public function getFichePersonnageRareteSsrs(): Collection
    {
        return $this->fichePersonnageRareteSsrs;
    }

    public function addFichePersonnageRareteSsr(FichePersonnageRareteSsr $fichePersonnageRareteSsr): self
    {
        if (!$this->fichePersonnageRareteSsrs->contains($fichePersonnageRareteSsr)) {
            $this->fichePersonnageRareteSsrs[] = $fichePersonnageRareteSsr;
            $fichePersonnageRareteSsr->setEncyclopediedupersonnage($this);
        }

        return $this;
    }

    public function removeFichePersonnageRareteSsr(FichePersonnageRareteSsr $fichePersonnageRareteSsr): self
    {
        if ($this->fichePersonnageRareteSsrs->removeElement($fichePersonnageRareteSsr)) {
            // set the owning side to null (unless already changed)
            if ($fichePersonnageRareteSsr->getEncyclopediedupersonnage() === $this) {
                $fichePersonnageRareteSsr->setEncyclopediedupersonnage(null);
            }
        }

        return $this;
    }

}
