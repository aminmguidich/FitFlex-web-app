<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\OfferRepository;
use App\Entity\ReservationOffer;

#[ORM\Entity(repositoryClass:OfferRepository::class)]
class Offer
{
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idOffer")]
    private ?int $idoffer=null;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $titleoffer=null;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $descriptionoffer=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column]
    private ?float $prix=null;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[ORM\Column]
    private \DateTime $datedeboffer;

    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\GreaterThanOrEqual(propertyPath: "datedeboffer", message: "La date de fin doit être postérieure à la date de début.")]
    #[ORM\Column]
    private \DateTime $datefinoffer;


    #[Assert\NotBlank(message: "champ obligatoire")]
    #[Assert\Positive(message: "champ invalid")]
    #[ORM\Column(length:255)]
    private ?string $img=null;

    #[ORM\OneToMany(mappedBy: 'idOffer', targetEntity: ReservationOffer::class)]
    private Collection $offers;

    public function __construct()
    {
        $this->offers = new ArrayCollection();
    }


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

    /**
     * @return Collection<int, ReservationOffer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(ReservationOffer $offer): static
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setIdOffer($this);
        }

        return $this;
    }

    public function removeOffer(ReservationOffer $offer): static
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getIdOffer() === $this) {
                $offer->setIdOffer(null);
            }
        }

        return $this;
    }


}
