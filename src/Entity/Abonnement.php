<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AbonnementRepository;
use App\Entity\User;
use App\Entity\TypeAbonn;

#[ORM\Entity(repositoryClass:AbonnementRepository::class)]
class Abonnement
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idabonement")]
    private ?int $idabonement=null;

    
    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\Column]
    private \DateTime $dateabonnement;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "Id",name: "idUser",onDelete: "CASCADE")]
    private ?User $iduser=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\ManyToOne(inversedBy: 'typeAbons')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "id",name: "typeAbon",onDelete: "CASCADE")]
    private ?TypeAbonn $typeabon=null;

    public function getIdabonement(): ?int
    {
        return $this->idabonement;
    }

    public function getDateabonnement(): ?\DateTimeInterface
    {
        return $this->dateabonnement;
    }

    public function setDateabonnement(\DateTimeInterface $dateabonnement): static
    {
        $this->dateabonnement = $dateabonnement;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): static
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getTypeabon(): ?TypeAbonn
    {
        return $this->typeabon;
    }

    public function setTypeabon(?TypeAbonn $typeabon): static
    {
        $this->typeabon = $typeabon;

        return $this;
    }


}
