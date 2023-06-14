<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\CatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CatRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['r-cat']],
    denormalizationContext: ['groups' => ['w-cat']],
)]
class Cat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['r:cat'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['r-cat', 'w-cat', 'w-human'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['r-cat', 'w-cat', 'w-human'])]
    private ?string $coatColor = null;

    #[ORM\Column(length: 1)]
    #[Groups(['r:cat'])]
    private ?string $sex = null;

    #[ORM\ManyToOne(inversedBy: 'cats')]
    #[Groups(['read:collection', 'write:collection'])]
    private ?Human $human = null;

    #[ORM\ManyToMany(targetEntity: Property::class, inversedBy: 'cats')]
    private Collection $properties;

    #[ORM\OneToMany(mappedBy: 'cat', targetEntity: Proposal::class)]
    private Collection $proposals;

    public function __construct()
    {
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

    public function getCoatColor(): ?string
    {
        return $this->coatColor;
    }

    public function setCoatColor(string $coatColor): self
    {
        $this->coatColor = $coatColor;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): self
    {
        $this->sex = $sex;

        return $this;
    }

    public function getHuman(): ?Human
    {
        return $this->human;
    }

    public function setHuman(?Human $human): self
    {
        $this->human = $human;

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
            $proposal->setCat($this);
        }

        return $this;
    }

    public function removeProposal(Proposal $proposal): self
    {
        if ($this->proposals->removeElement($proposal)) {
            // set the owning side to null (unless already changed)
            if ($proposal->getCat() === $this) {
                $proposal->setCat(null);
            }
        }

        return $this;
    }
}