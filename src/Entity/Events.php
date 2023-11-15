<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="idtype", columns={"idtype"})})
 * @ORM\Entity
 */
class Events
{
    /**
     * @var int
     *
     * @ORM\Column(name="idEvent", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idevent;

    /**
     * @var string
     *
     * @ORM\Column(name="titreEvent", type="string", length=150, nullable=false)
     */
    private $titreevent;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCoach", type="string", length=150, nullable=false)
     */
    private $nomcoach;

    /**
     * @var string
     *
     * @ORM\Column(name="typeEvent", type="string", length=150, nullable=false)
     */
    private $typeevent;

    /**
     * @var string
     *
     * @ORM\Column(name="adresseEvent", type="string", length=150, nullable=false)
     */
    private $adresseevent;

    /**
     * @var float
     *
     * @ORM\Column(name="prixEvent", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixevent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEvent", type="date", nullable=false)
     */
    private $dateevent;

    /**
     * @var string
     *
     * @ORM\Column(name="imgEvent", type="string", length=150, nullable=false)
     */
    private $imgevent;

    /**
     * @var int
     *
     * @ORM\Column(name="nombrePlacesReservees", type="integer", nullable=false)
     */
    private $nombreplacesreservees;

    /**
     * @var int
     *
     * @ORM\Column(name="nombrePlacesTotal", type="integer", nullable=false)
     */
    private $nombreplacestotal;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idUser", referencedColumnName="Id")
     * })
     */
    private $iduser;

    /**
     * @var \TypeEvent
     *
     * @ORM\ManyToOne(targetEntity="TypeEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idtype", referencedColumnName="id")
     * })
     */
    private $idtype;

    public function getIdevent(): ?int
    {
        return $this->idevent;
    }

    public function getTitreevent(): ?string
    {
        return $this->titreevent;
    }

    public function setTitreevent(string $titreevent): static
    {
        $this->titreevent = $titreevent;

        return $this;
    }

    public function getNomcoach(): ?string
    {
        return $this->nomcoach;
    }

    public function setNomcoach(string $nomcoach): static
    {
        $this->nomcoach = $nomcoach;

        return $this;
    }

    public function getTypeevent(): ?string
    {
        return $this->typeevent;
    }

    public function setTypeevent(string $typeevent): static
    {
        $this->typeevent = $typeevent;

        return $this;
    }

    public function getAdresseevent(): ?string
    {
        return $this->adresseevent;
    }

    public function setAdresseevent(string $adresseevent): static
    {
        $this->adresseevent = $adresseevent;

        return $this;
    }

    public function getPrixevent(): ?float
    {
        return $this->prixevent;
    }

    public function setPrixevent(float $prixevent): static
    {
        $this->prixevent = $prixevent;

        return $this;
    }

    public function getDateevent(): ?\DateTimeInterface
    {
        return $this->dateevent;
    }

    public function setDateevent(\DateTimeInterface $dateevent): static
    {
        $this->dateevent = $dateevent;

        return $this;
    }

    public function getImgevent(): ?string
    {
        return $this->imgevent;
    }

    public function setImgevent(string $imgevent): static
    {
        $this->imgevent = $imgevent;

        return $this;
    }

    public function getNombreplacesreservees(): ?int
    {
        return $this->nombreplacesreservees;
    }

    public function setNombreplacesreservees(int $nombreplacesreservees): static
    {
        $this->nombreplacesreservees = $nombreplacesreservees;

        return $this;
    }

    public function getNombreplacestotal(): ?int
    {
        return $this->nombreplacestotal;
    }

    public function setNombreplacestotal(int $nombreplacestotal): static
    {
        $this->nombreplacestotal = $nombreplacestotal;

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

    public function getIdtype(): ?TypeEvent
    {
        return $this->idtype;
    }

    public function setIdtype(?TypeEvent $idtype): static
    {
        $this->idtype = $idtype;

        return $this;
    }


}
