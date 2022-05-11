<?php

namespace App\Entity;

use App\Repository\OffersSkillsAssocRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffersSkillsAssocRepository::class)]
#[ORM\HasLifecycleCallbacks]

class OffersSkillsAssoc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\OneToMany(mappedBy: 'OffersSkillsAssoc', targetEntity: Skill::class)]
    private $offer;

    #[ORM\OneToMany(mappedBy: 'OffersSkillsAssoc', targetEntity: Offer::class)]
    private $skills;

    #[ORM\Column(type: 'datetime_immutable')]
    private $created_at;

    #[ORM\Column(type: 'datetime_immutable')]
    private $modified_at;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setModifiedAt(new \DateTimeImmutable());
        $this->offers = new ArrayCollection();
        $this->offer = new ArrayCollection();
        $this->skills = new ArrayCollection();
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

    /**
     * @return Collection<int, skill>
     */
    public function getOffer(): Collection
    {
        return $this->offer;
    }

    public function addOffer(skill $offer): self
    {
        if (!$this->offer->contains($offer)) {
            $this->offer[] = $offer;
            $offer->setAssocOffersSkills($this);
        }

        return $this;
    }

    public function removeOffer(skill $offer): self
    {
        if ($this->offer->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getAssocOffersSkills() === $this) {
                $offer->setAssocOffersSkills(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, offer>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(offer $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setSkillsToOfferAssoc($this);
        }

        return $this;
    }

    public function removeSkill(offer $skill): self
    {
        if ($this->skills->removeElement($skill)) {
            // set the owning side to null (unless already changed)
            if ($skill->getSkillsToOfferAssoc() === $this) {
                $skill->setSkillsToOfferAssoc(null);
            }
        }

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
