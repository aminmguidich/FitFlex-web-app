<?php

namespace App\Entity;
use App\Repository\categoriemagasinRepository;
use Doctrine\ORM\Mapping;

#[Mapping\Entity(repositoryClass: categoriemagasinRepository::class)]
class categoriemagasin
{
    #[Mapping\Id]
    #[Mapping\GeneratedValue(strategy: "IDENTITY")]
    #[Mapping\Column(name: "id")]
    private ?int $id = null;

    #[Mapping\Column(length: 255)]
    private ?string $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }
}
