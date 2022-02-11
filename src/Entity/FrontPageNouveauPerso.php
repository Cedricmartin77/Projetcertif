<?php

namespace App\Entity;

use App\Repository\FrontPageNouveauPersoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FrontPageNouveauPersoRepository::class)]
class FrontPageNouveauPerso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $img;

    #[ORM\ManyToOne(targetEntity: FichePersonnage::class, inversedBy: 'frontPageNouveauPersos')]
    #[ORM\JoinColumn(nullable: false)]
    private $fichepersonnage;

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

    public function getFichepersonnage(): ?FichePersonnage
    {
        return $this->fichepersonnage;
    }

    public function setFichepersonnage(?FichePersonnage $fichepersonnage): self
    {
        $this->fichepersonnage = $fichepersonnage;

        return $this;
    }
}
