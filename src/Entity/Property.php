<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ApiResource]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 125, unique: true)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Human::class, mappedBy: 'properties')]
    private Collection $humans;

    #[ORM\ManyToMany(targetEntity: Cat::class, mappedBy: 'properties')]
    private Collection $cats;

    public function __construct()
    {
        $this->humans = new ArrayCollection();
        $this->cats = new ArrayCollection();
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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, Human>
     */
    public function getHumans(): Collection
    {
        return $this->humans;
    }

    public function addHuman(Human $human): self
    {
        if (!$this->humans->contains($human)) {
            $this->humans->add($human);
            $human->addProperty($this);
        }

        return $this;
    }

    public function removeHuman(Human $human): self
    {
        if ($this->humans->removeElement($human)) {
            $human->removeProperty($this);
        }

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
            $cat->addProperty($this);
        }

        return $this;
    }

    public function removeCat(Cat $cat): self
    {
        if ($this->cats->removeElement($cat)) {
            $cat->removeProperty($this);
        }

        return $this;
    }
}
