<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationCours
 *
 * @ORM\Table(name="reservation_cours", indexes={@ORM\Index(name="reservation_cours_ibfk_2", columns={"code"})})
 * @ORM\Entity
 */
class ReservationCours
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date_res", type="datetime", nullable=true)
     */
    private $dateRes;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var \Activites
     *
     * @ORM\ManyToOne(targetEntity="Activites")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="code", referencedColumnName="code")
     * })
     */
    private $code;

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
