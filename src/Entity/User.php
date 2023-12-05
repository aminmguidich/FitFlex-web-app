<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass:UserRepository::class)]
class User implements UserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "Id")]
    private ?int $id = null;

    #[ORM\Column(length:255)]
    private ?string $nom = null;

    #[ORM\Column(length:255)]
    private ?string $prenom = null;

    #[ORM\Column(length:255)]
    private ?string $mdp = null;

    #[ORM\Column(length:255)]
    private ?string $role = null;

    #[ORM\Column(length:255)]
    private ?string $email = null;

    #[ORM\Column(length:255)]
    private ?string $img = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(name: "numtel", type: "integer", nullable: false)]
    private ?int $numtel = null;

    #[ORM\Column(name: "sex", type: "string", length: 300, nullable: false)]
    private ?string $sex = null;




    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        // Hash the password using bcrypt algorithm
        $hashedPassword = password_hash($mdp, PASSWORD_BCRYPT);
    
        $this->mdp = $hashedPassword;
    
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    // Required methods for UserInterface

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function getSalt(): ?string
    {
        // You can leave this method blank or return a salt
        return null;
    }

    public function getUsername(): ?string
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
    public function getsex(): ?string
    {
        return $this->sex;
    }

    public function setsex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getnumtel(): ?int
    {
        return $this->numtel;
    }

    public function setnumtel(int $numtel): self
    {
        $this->numtel = $numtel;

        return $this;
    }
   
}
