<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Persistence\Event\LifecycleEventArgs;

#[ORM\HasLifecycleCallbacks]
#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{

    // Manque Assoc avec skill
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: OffersType::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private $offers_type;

    #[ORM\Column(type: 'string', length: 255)]
    private $job_name;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'text')]
    private $tasks;

    #[ORM\Column(type: 'integer')]
    private $week_hours_number;

    #[ORM\Column(type: 'string', length: 255)]
    private $town;

    #[ORM\ManyToOne(targetEntity: Department::class, inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private $department;

    #[ORM\Column(type: 'text', nullable: true)]
    private $address;

    #[ORM\Column(type: 'string', length: 255)]
    private $company;

    #[ORM\Column(type: 'integer')]
    private $experience;

    #[ORM\Column(type: 'boolean')]
    private $active;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $modified_at;

    #[ORM\ManyToOne(targetEntity: SubCategory::class)]
    private $id_sub_category;

    #[ORM\ManyToOne(targetEntity: User::class)]
    private $recruiter;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setModifiedAt(new \DateTimeImmutable());
        $this->setActive(true);
    }

    #[ORM\PreUpdate]
    public function updateModificationDate(): void
    {
        $this->setModifiedAt(new \DateTimeImmutable());
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffersType(): ?OffersType
    {
        return $this->offers_type;
    }

    public function setOffersType(?OffersType $offers_type): self
    {
        $this->offers_type = $offers_type;

        return $this;
    }

    public function getJobName(): ?string
    {
        return $this->job_name;
    }

    public function setJobName(string $job_name): self
    {
        $this->job_name = $job_name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTasks(): ?string
    {
        return $this->tasks;
    }

    public function setTasks(string $tasks): self
    {
        $this->tasks = $tasks;

        return $this;
    }

    public function getWeekHoursNumber(): ?int
    {
        return $this->week_hours_number;
    }

    public function setWeekHoursNumber(int $week_hours_number): self
    {
        $this->week_hours_number = $week_hours_number;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown(string $town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getDepartment(): ?Department
    {
        return $this->department;
    }

    public function setDepartment(?Department $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

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

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modified_at;
    }

    public function setModifiedAt(\DateTimeImmutable $modified_at): self
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    public function getDataArray(): array
    {
        $data = array();
        $data['id'] = $this->getId();
        $data['job_name'] = $this->getJobName();
        $data['description'] = $this->getDescription();
        $data['tasks'] = $this->getTasks();
        $data['week_hours_number'] = $this->getWeekHoursNumber();
        $data['town'] = $this->getTown();
        // $data['address'] = $this->getAddress();
        $data['company'] = $this->getCompany();
        $data['experience'] = $this->getExperience();
        // $data['offers_type_id'] = $this->getOffersType()->getId();
        // $data['department_id'] = $this->getDepartment()->getId();

        return $data;
    }

    public function getIdSubCategory(): ?SubCategory
    {
        return $this->id_sub_category;
    }

    public function setIdSubCategory(?SubCategory $id_sub_category): self
    {
        $this->id_sub_category = $id_sub_category;

        return $this;
    }

    public function getRecruiter(): ?user
    {
        return $this->recruiter;
    }

    public function setRecruiter(?user $recruiter): self
    {
        $this->recruiter = $recruiter;

        return $this;
    }
}