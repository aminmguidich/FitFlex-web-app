<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProduitCommande
 *
 * @ORM\Table(name="produit_commande", indexes={@ORM\Index(name="id_cmd", columns={"id_cmd"}), @ORM\Index(name="id_prd", columns={"id_prd"})})
 * @ORM\Entity
 */
class ProduitCommande
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
     * @var int
     *
     * @ORM\Column(name="id_prd", type="integer", nullable=false)
     */
    private $idPrd;

    /**
     * @var int
     *
     * @ORM\Column(name="id_cmd", type="integer", nullable=false)
     */
    private $idCmd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPrd(): ?int
    {
        return $this->idPrd;
    }

    public function setIdPrd(int $idPrd): static
    {
        $this->idPrd = $idPrd;

        return $this;
    }

    public function getIdCmd(): ?int
    {
        return $this->idCmd;
    }

    public function setIdCmd(int $idCmd): static
    {
        $this->idCmd = $idCmd;

        return $this;
    }


}
