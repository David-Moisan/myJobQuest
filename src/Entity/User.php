<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(type: 'string', length: 100)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 100)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 200)]
    private $address;

    #[ORM\Column(type: 'string', length: 5)]
    private $postal_code;

    #[ORM\Column(type: 'string', length: 100)]
    private $city;

    #[ORM\Column(type: 'json')]
    private $roles = [];

    #[ORM\Column(type: 'string')]
    private $password;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $created_at;

    #[ORM\OneToMany(mappedBy: 'users', targetEntity: ApplyJob::class)]
    private $applyJobs;

    public function __construct()
    {
        $this->applyJobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

     /**
     * Get the value of firstname
     */ 
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     * @return  self
     */ 
    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * Get the value of lastname
     */ 
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     * @return  self
     */ 
    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return  self
     */ 
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of postal_code
     */ 
    public function getPostal_code(): string
    {
        return $this->postal_code;
    }

    /**
     * @param string $postal_code
     * @return  self
     */ 
    public function setPostal_code(string $postal_code): self
    {
        $this->postal_code = $postal_code;

        return $this;
    }

    /**
     * Get the value of city
     */ 
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return  self
     */ 
    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, ApplyJob>
     */
    public function getApplyJobs(): Collection
    {
        return $this->applyJobs;
    }

    public function addApplyJob(ApplyJob $applyJob): self
    {
        if (!$this->applyJobs->contains($applyJob)) {
            $this->applyJobs[] = $applyJob;
            $applyJob->setUsers($this);
        }

        return $this;
    }

    public function removeApplyJob(ApplyJob $applyJob): self
    {
        if ($this->applyJobs->removeElement($applyJob)) {
            // set the owning side to null (unless already changed)
            if ($applyJob->getUsers() === $this) {
                $applyJob->setUsers(null);
            }
        }

        return $this;
    }
}
