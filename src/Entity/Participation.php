<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Participation
 *
 * @ORM\Table(name="participation", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="participation_ibfk_1", columns={"idEvent"})})
 * @ORM\Entity
 */
class Participation
{
    /**
     * @var int
     *
     * @ORM\Column(name="idPart", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpart;

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=150, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenom", type="string", length=150, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="Ntel", type="string", length=150, nullable=false)
     */
    private $ntel;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePart", type="date", nullable=false)
     */
    private $datepart;

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
     * @var \Events
     *
     * @ORM\ManyToOne(targetEntity="Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEvent", referencedColumnName="idEvent")
     * })
     */
    private $idevent;

    public function getIdpart(): ?int
    {
        return $this->idpart;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNtel(): ?string
    {
        return $this->ntel;
    }

    public function setNtel(string $ntel): static
    {
        $this->ntel = $ntel;

        return $this;
    }

    public function getDatepart(): ?\DateTimeInterface
    {
        return $this->datepart;
    }

    public function setDatepart(\DateTimeInterface $datepart): static
    {
        $this->datepart = $datepart;

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

    public function getIdevent(): ?Events
    {
        return $this->idevent;
    }

    public function setIdevent(?Events $idevent): static
    {
        $this->idevent = $idevent;

        return $this;
    }


}
