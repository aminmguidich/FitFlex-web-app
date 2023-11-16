<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitCommande
 */
#[ORM\Table(name: "produit_commande")]
#[ORM\Entity]
class produitcommande
{
   
    #[ORM\Column(name: "id", type: "integer", nullable: false)]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private ?int $id = null;

   
    #[ORM\Column(name: "id_prd", type: "integer", nullable: false)]
    private ?int $idPrd = null;

  
    #[ORM\Column(name: "id_cmd", type: "integer", nullable: false)]
    private ?int $idCmd = null;

    
    #[ORM\ManyToOne(targetEntity: produit::class)]
    #[ORM\JoinColumn(name: "id_prd", referencedColumnName: "id")]
    private ?produit $produit;

    
    #[ORM\ManyToOne(targetEntity: Commande::class)]
    #[ORM\JoinColumn(name: "id_cmd", referencedColumnName: "id")]
    private ?Commande $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPrd(): ?int
    {
        return $this->idPrd;
    }

    public function setIdPrd(?int $idPrd): self
    {
        $this->idPrd = $idPrd;

        return $this;
    }

    public function getIdCmd(): ?int
    {
        return $this->idCmd;
    }

    public function setIdCmd(?int $idCmd): self
    {
        $this->idCmd = $idCmd;

        return $this;
    }

    public function getProduit(): ?produit
    {
        return $this->produit;
    }

    public function setProduit(?produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}
