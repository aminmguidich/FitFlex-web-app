<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentRepository;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "idc")]
    private ?int $idc = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'comment')]
    #[ORM\JoinColumn(nullable: false , referencedColumnName: "idpost",name: "idpost",onDelete: "CASCADE")]
    private ?Post $idpost = null;

    #[ORM\ManyToOne(inversedBy: 'comment')]
    #[ORM\JoinColumn(nullable: false, referencedColumnName: "Id", name: "idUser", onDelete: "CASCADE")]
    private ?User $idUser = null;

    public function getIdc(): ?int
    {
        return $this->idc;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getIdpost(): ?Post
    {
        return $this->idpost;
    }

    public function setIdpost(?Post $idpost): static
    {
        $this->idpost = $idpost;

        return $this;
    }


    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): static
    {
        $this->idUser = $idUser;

        return $this;
    }
}
