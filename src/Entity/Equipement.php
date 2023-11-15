<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Equipement
 *
 * @ORM\Table(name="equipement", indexes={@ORM\Index(name="idUser", columns={"idUser"}), @ORM\Index(name="forgin key", columns={"IdCategorie"})})
 * @ORM\Entity
 */
class Equipement
{
    /**
     * @var int
     *
     * @ORM\Column(name="IdEquipement", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idequipement;

    /**
     * @var string
     *
     * @ORM\Column(name="NomEquipement", type="string", length=255, nullable=false)
     */
    private $nomequipement;

    /**
     * @var int
     *
     * @ORM\Column(name="Quantite", type="integer", nullable=false)
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAchat", type="date", nullable=false)
     */
    private $dateachat;

    /**
     * @var float
     *
     * @ORM\Column(name="PrixAchat", type="float", precision=10, scale=0, nullable=false)
     */
    private $prixachat;

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
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdCategorie", referencedColumnName="IdCategorie")
     * })
     */
    private $idcategorie;

    public function getIdequipement(): ?int
    {
        return $this->idequipement;
    }

    public function getNomequipement(): ?string
    {
        return $this->nomequipement;
    }

    public function setNomequipement(string $nomequipement): static
    {
        $this->nomequipement = $nomequipement;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateachat(): ?\DateTimeInterface
    {
        return $this->dateachat;
    }

    public function setDateachat(\DateTimeInterface $dateachat): static
    {
        $this->dateachat = $dateachat;

        return $this;
    }

    public function getPrixachat(): ?float
    {
        return $this->prixachat;
    }

    public function setPrixachat(float $prixachat): static
    {
        $this->prixachat = $prixachat;

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

    public function getIdcategorie(): ?Categorie
    {
        return $this->idcategorie;
    }

    public function setIdcategorie(?Categorie $idcategorie): static
    {
        $this->idcategorie = $idcategorie;

        return $this;
    }


}
