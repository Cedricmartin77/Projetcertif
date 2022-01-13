<?php

namespace App\Entity;

use App\Repository\EncyclopedieDesPersonnagesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EncyclopedieDesPersonnagesRepository::class)]
class EncyclopedieDesPersonnages
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\OneToMany(mappedBy: 'encyclopedieDesPersonnages', targetEntity: EncyclopedieDuPersonnage::class, orphanRemoval: true)]
    private $encyclopediedupersonnage;

    public function __construct()
    {
        $this->encyclopediedupersonnage = new ArrayCollection();
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

    /**
     * @return Collection|EncyclopedieDuPersonnage[]
     */
    public function getEncyclopediedupersonnage(): Collection
    {
        return $this->encyclopediedupersonnage;
    }

    public function addEncyclopediedupersonnage(EncyclopedieDuPersonnage $encyclopediedupersonnage): self
    {
        if (!$this->encyclopediedupersonnage->contains($encyclopediedupersonnage)) {
            $this->encyclopediedupersonnage[] = $encyclopediedupersonnage;
            $encyclopediedupersonnage->setEncyclopedieDesPersonnages($this);
        }

        return $this;
    }

    public function removeEncyclopediedupersonnage(EncyclopedieDuPersonnage $encyclopediedupersonnage): self
    {
        if ($this->encyclopediedupersonnage->removeElement($encyclopediedupersonnage)) {
            // set the owning side to null (unless already changed)
            if ($encyclopediedupersonnage->getEncyclopedieDesPersonnages() === $this) {
                $encyclopediedupersonnage->setEncyclopedieDesPersonnages(null);
            }
        }

        return $this;
    }

}
