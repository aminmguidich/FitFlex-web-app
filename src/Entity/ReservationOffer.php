<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationOffer
 *
 * @ORM\Table(name="reservation_offer", indexes={@ORM\Index(name="idOffer", columns={"idOffer"}), @ORM\Index(name="idUser", columns={"idUser"})})
 * @ORM\Entity
 */
class ReservationOffer
{
    /**
     * @var int
     *
     * @ORM\Column(name="idReservation", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReservation", type="date", nullable=false)
     */
    private $datereservation;

    /**
     * @var string
     *
     * @ORM\Column(name="codePromo", type="string", length=255, nullable=false)
     */
    private $codepromo;

    /**
     * @var \Offer
     *
     * @ORM\ManyToOne(targetEntity="Offer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idOffer", referencedColumnName="idOffer")
     * })
     */
    private $idoffer;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="Id")
     * })
     */
    private $iduser;

    public function getIdreservation(): ?int
    {
        return $this->idreservation;
    }

    public function getDatereservation(): ?\DateTimeInterface
    {
        return $this->datereservation;
    }

    public function setDatereservation(\DateTimeInterface $datereservation): static
    {
        $this->datereservation = $datereservation;

        return $this;
    }

    public function getCodepromo(): ?string
    {
        return $this->codepromo;
    }

    public function setCodepromo(string $codepromo): static
    {
        $this->codepromo = $codepromo;

        return $this;
    }

    public function getIdoffer(): ?Offer
    {
        return $this->idoffer;
    }

    public function setIdoffer(?Offer $idoffer): static
    {
        $this->idoffer = $idoffer;

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


}
