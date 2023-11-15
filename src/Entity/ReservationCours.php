<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ReservationCoursRepository;
#[ORM\Entity(repositoryClass: ReservationCoursRepository::class)]
class ReservationCours
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id")]
    private ?int $id=null;


    #[ORM\Column]
    private ?\dateRes $dateRes;


    #[ORM\Column]
    private ?int $idUser= null;


    #[ORM\ManyToOne(inversedBy: 'reservation')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "code",name: "code",onDelete: "CASCADE")]
    private ?Activites $code = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRes(): ?\DateTimeInterface
    {
        return $this->dateRes;
    }

    public function setDateRes(?\DateTimeInterface $dateRes): static
    {
        $this->dateRes = $dateRes;

        return $this;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getCode(): ?Activites
    {
        return $this->code;
    }

    public function setCode(?Activites $code): static
    {
        $this->code = $code;

        return $this;
    }


}
