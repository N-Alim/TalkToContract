<?php

namespace App\Entity;

use App\Repository\OfferTypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferTypeRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OfferType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $label;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $modified_at;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setModifiedAt(new \DateTimeImmutable());
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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
}
