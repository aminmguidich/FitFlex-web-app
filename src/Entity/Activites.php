<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ActivitesRepository;


#[ORM\Entity(repositoryClass: ActivitesRepository::class)]
#[ORM\Table(name: "activites")]
class Activites
{


     #[ORM\Column]
     #[ORM\Id]
     #[ORM\GeneratedValue]

    private ?int $code= null;
    #[ORM\Column(length: 255 )]

    private ?string $categorie=null;


    #[ORM\Column]
    private ?\DateTime $dateDeb = null;

    #[ORM\Column]
    private ?\DateTime $dateFin = null;

    #[ORM\Column(length: 255 )]
    private ?string  $description;

    #[ORM\Column(length: 255 )]
    private ?string $salle=null;

    #[ORM\Column(length: 255 )]
    private ?string $titre;

    #[ORM\ManyToOne(inversedBy: 'activities')]
    private ?Categorieactivite $idcategorie=null;
    #[ORM\ManyToOne(inversedBy: 'activities')]
    private ?User $idUser = null;

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function getCategorie(): ?string
    {
        return $this->categorie;
    }

    public function setCategorie(?string $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getDateDeb(): ?\DateTimeInterface
    {
        return $this->dateDeb;
    }

    public function setDateDeb(?\DateTimeInterface $dateDeb): static
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(?\DateTimeInterface $dateFin): static
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getSalle(): ?string
    {
        return $this->salle;
    }

    public function setSalle(?string $salle): static
    {
        $this->salle = $salle;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getIdcategorie(): ?Categorieactivite
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?Categorieactivite $idcategorie): static
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }


}
