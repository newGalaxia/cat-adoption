<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HumanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: HumanRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['r-human']],
    denormalizationContext: ['groups' => ['w-human']],
)]
class Human
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['r-human'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['w-human', 'r-human', 'r-property'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'human', targetEntity: Cat::class, cascade: ["persist"], orphanRemoval: false)]
    #[Groups(['r-human'])]
    private Collection $cats;

    #[ORM\ManyToMany(targetEntity: Property::class, inversedBy: 'humans', cascade: ["persist"], orphanRemoval: false)]
    #[Groups(['w-human', 'r-human'])]
    private Collection $properties;

    #[ORM\OneToMany(mappedBy: 'human', targetEntity: Proposal::class)]
    private Collection $proposals;

    public function __construct()
    {
        $this->cats = new ArrayCollection();
        $this->properties = new ArrayCollection();
        $this->proposals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Cat>
     */
    public function getCats(): Collection
    {
        return $this->cats;
    }

    public function addCat(Cat $cat): self
    {
        if (!$this->cats->contains($cat)) {
            $this->cats->add($cat);
            $cat->setHuman($this);
        }

        return $this;
    }

    public function removeCat(Cat $cat): self
    {
        if ($this->cats->removeElement($cat)) {
            // set the owning side to null (unless already changed)
            if ($cat->getHuman() === $this) {
                $cat->setHuman(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Property>
     */
    public function getProperties(): Collection
    {
        return $this->properties;
    }

    public function addProperty(Property $property): self
    {
        if (!$this->properties->contains($property)) {
            $this->properties->add($property);
        }

        return $this;
    }

    public function removeProperty(Property $property): self
    {
        $this->properties->removeElement($property);

        return $this;
    }

    /**
     * @return Collection<int, Proposal>
     */
    public function getProposals(): Collection
    {
        return $this->proposals;
    }

    public function addProposal(Proposal $proposal): self
    {
        if (!$this->proposals->contains($proposal)) {
            $this->proposals->add($proposal);
            $proposal->setHuman($this);
        }

        return $this;
    }

    public function removeProposal(Proposal $proposal): self
    {
        if ($this->proposals->removeElement($proposal)) {
            // set the owning side to null (unless already changed)
            if ($proposal->getHuman() === $this) {
                $proposal->setHuman(null);
            }
        }

        return $this;
    }
}
