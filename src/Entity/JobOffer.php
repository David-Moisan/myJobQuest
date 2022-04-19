<?php

namespace App\Entity;

use App\Repository\JobOfferRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobOfferRepository::class)]
class JobOffer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'string', length: 50)]
    private $level_search;

    #[ORM\Column(type: 'string', length: 80, nullable: true)]
    private $salary;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $experience_required;

    #[ORM\Column(type: 'boolean')]
    private $english_required;

    #[ORM\Column(type: 'boolean')]
    private $remote;

    #[ORM\Column(type: 'text', nullable: true)]
    private $comment;

    #[ORM\ManyToOne(targetEntity: Company::class, inversedBy: 'jobOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private $companies;

    #[ORM\ManyToMany(targetEntity: Stack::class, inversedBy: 'jobOffers')]
    private $stacks;

    #[ORM\ManyToOne(targetEntity: JobType::class, inversedBy: 'jobOffers')]
    #[ORM\JoinColumn(nullable: false)]
    private $type_job;

    #[ORM\OneToMany(mappedBy: 'jobs', targetEntity: ApplyJob::class)]
    private $applyJobs;

    public function __construct()
    {
        $this->stacks = new ArrayCollection();
        $this->applyJobs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLevelSearch(): ?string
    {
        return $this->level_search;
    }

    public function setLevelSearch(string $level_search): self
    {
        $this->level_search = $level_search;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getExperienceRequired(): ?int
    {
        return $this->experience_required;
    }

    public function setExperienceRequired(?int $experience_required): self
    {
        $this->experience_required = $experience_required;

        return $this;
    }

    public function getEnglishRequired(): ?bool
    {
        return $this->english_required;
    }

    public function setEnglishRequired(bool $english_required): self
    {
        $this->english_required = $english_required;

        return $this;
    }

    public function getRemote(): ?bool
    {
        return $this->remote;
    }

    public function setRemote(bool $remote): self
    {
        $this->remote = $remote;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getCompanies(): ?Company
    {
        return $this->companies;
    }

    public function setCompanies(?Company $companies): self
    {
        $this->companies = $companies;

        return $this;
    }

    /**
     * @return Collection<int, Stack>
     */
    public function getStacks(): Collection
    {
        return $this->stacks;
    }

    public function addStack(Stack $stack): self
    {
        if (!$this->stacks->contains($stack)) {
            $this->stacks[] = $stack;
        }

        return $this;
    }

    public function removeStack(Stack $stack): self
    {
        $this->stacks->removeElement($stack);

        return $this;
    }

    public function getTypeJob(): ?JobType
    {
        return $this->type_job;
    }

    public function setTypeJob(?JobType $type_job): self
    {
        $this->type_job = $type_job;

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
            $applyJob->setJobs($this);
        }

        return $this;
    }

    public function removeApplyJob(ApplyJob $applyJob): self
    {
        if ($this->applyJobs->removeElement($applyJob)) {
            // set the owning side to null (unless already changed)
            if ($applyJob->getJobs() === $this) {
                $applyJob->setJobs(null);
            }
        }

        return $this;
    }
}
