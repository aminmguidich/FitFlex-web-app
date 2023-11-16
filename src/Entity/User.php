<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\UserRepository;
use App\Entity\Commande;

#[ORM\Entity(repositoryClass:UserRepository::class)]
class User
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id")]
    private ?int $id=null;


    #[ORM\Column(length:255)]
    private ?string $nom=null;

  
    #[ORM\Column(length:255)]
    private ?string $prenom=null;
 
    #[ORM\Column(length:255)]
    private ?string $mdp=null;
    
    #[ORM\Column(length:255)]
    private ?string $role=null;


    #[ORM\Column(length:255)]
    private ?string $email=null;



    #[ORM\Column(length:255)]
    private ?string $img=null;



    #[ORM\Column]
    private ?int $age=null;

   

    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Commande::class)]
    private Collection $usersC;

    public function __construct()
    {
        $this->usersC = new ArrayCollection();
    }

 
    public function getId(): ?int
    {
        return $this->id;
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

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): static
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

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

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): static
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getUsersC(): Collection
    {
        return $this->usersC;
    }

    public function addUsersC(Commande $usersC): static
    {
        if (!$this->usersC->contains($usersC)) {
            $this->usersC->add($usersC);
            $usersC->setId($this);
        }

        return $this;
    }

    public function removeUsersC(Commande $usersC): static
    {
        if ($this->usersC->removeElement($usersC)) {
            // set the owning side to null (unless already changed)
            if ($usersC->getId() === $this) {
                $usersC->setId(null);
            }
        }

        return $this;
    }



}
