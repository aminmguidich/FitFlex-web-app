<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\UserRepository;


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

    
    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Events::class)]
    private Collection $users;
    #[ORM\OneToMany(mappedBy: 'Id', targetEntity: Participation::class)]
    private Collection $usersP;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->usersP = new ArrayCollection();
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
     * @return Collection<int, Abonnement>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(Abonnement $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setId($this);
        }

        return $this;
    }

    public function removeUser(Abonnement $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getId() === $this) {
                $user->setId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getUsersP(): Collection
    {
        return $this->usersP;
    }

    public function addUsersP(Participation $usersP): static
    {
        if (!$this->usersP->contains($usersP)) {
            $this->usersP->add($usersP);
            $usersP->setId($this);
        }

        return $this;
    }

    public function removeUsersP(Participation $usersP): static
    {
        if ($this->usersP->removeElement($usersP)) {
            // set the owning side to null (unless already changed)
            if ($usersP->getId() === $this) {
                $usersP->setId(null);
            }
        }

        return $this;
    }


}
