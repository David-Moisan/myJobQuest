<?php

namespace App\Entity;

use App\Repository\ApplyJobRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplyJobRepository::class)]
class ApplyJob
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_send;

    #[ORM\Column(type: 'date', nullable: true)]
    private $date_response;

    #[ORM\Column(type: 'boolean')]
    private $is_accepted;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'applyJobs')]
    private $users;

    #[ORM\ManyToOne(targetEntity: JobOffer::class, inversedBy: 'applyJobs')]
    private $jobs;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSend(): ?\DateTimeInterface
    {
        return $this->date_send;
    }

    public function setDateSend(\DateTimeInterface $date_send): self
    {
        $this->date_send = $date_send;

        return $this;
    }

    public function getDateResponse(): ?\DateTimeInterface
    {
        return $this->date_response;
    }

    public function setDateResponse(?\DateTimeInterface $date_response): self
    {
        $this->date_response = $date_response;

        return $this;
    }

    public function getIsAccepted(): ?bool
    {
        return $this->is_accepted;
    }

    public function setIsAccepted(bool $is_accepted): self
    {
        $this->is_accepted = $is_accepted;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getJobs(): ?JobOffer
    {
        return $this->jobs;
    }

    public function setJobs(?JobOffer $jobs): self
    {
        $this->jobs = $jobs;

        return $this;
    }
}
