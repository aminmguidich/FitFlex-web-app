<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offer
 *
 * @ORM\Table(name="offer")
 * @ORM\Entity
 */
class Offer
{
    /**
     * @var int
     *
     * @ORM\Column(name="idOffer", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idoffer;

    /**
     * @var string
     *
     * @ORM\Column(name="titleOffer", type="string", length=255, nullable=false)
     */
    private $titleoffer;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionOffer", type="string", length=255, nullable=false)
     */
    private $descriptionoffer;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=false)
     */
    private $prix;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebOffer", type="date", nullable=false)
     */
    private $datedeboffer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFinOffer", type="date", nullable=false)
     */
    private $datefinoffer;

    /**
     * @var string
     *
     * @ORM\Column(name="img", type="string", length=255, nullable=false)
     */
    private $img;

    public function getIdoffer(): ?int
    {
        return $this->idoffer;
    }

    public function getTitleoffer(): ?string
    {
        return $this->titleoffer;
    }

    public function setTitleoffer(string $titleoffer): static
    {
        $this->titleoffer = $titleoffer;

        return $this;
    }

    public function getDescriptionoffer(): ?string
    {
        return $this->descriptionoffer;
    }

    public function setDescriptionoffer(string $descriptionoffer): static
    {
        $this->descriptionoffer = $descriptionoffer;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDatedeboffer(): ?\DateTimeInterface
    {
        return $this->datedeboffer;
    }

    public function setDatedeboffer(\DateTimeInterface $datedeboffer): static
    {
        $this->datedeboffer = $datedeboffer;

        return $this;
    }

    public function getDatefinoffer(): ?\DateTimeInterface
    {
        return $this->datefinoffer;
    }

    public function setDatefinoffer(\DateTimeInterface $datefinoffer): static
    {
        $this->datefinoffer = $datefinoffer;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): static
    {
        $this->img = $img;

        return $this;
    }


}
