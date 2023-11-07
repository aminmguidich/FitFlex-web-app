<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AbonnementRepository;

#[ORM\Entity(repositoryClass: AbonnementRepository::class)]
class Abonnement
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idAbonement= null;


   /**
     * @ORM\Column(name="dateAbonnement", type="date", nullable=false)
     */
    private \DateTimeInterface $dateabonnement;
   
    #[ORM\ManyToOne(inversedBy: 'abonnement')]
    private ?User $user = null;
    

    #[ORM\ManyToOne(inversedBy: 'abonnement')]
    private ?TypeAbon $typeAbon = null;
    

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
