<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\PropertyCreation;
use App\Repository\PropertyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PropertyRepository::class)]
#[ApiResource(    
    normalizationContext: ['groups' => ['r-property']],
    denormalizationContext: ['groups' => ['w-property']],
    operations: [
        new GetCollection(),
        new Get(),
        new Delete(),
        new Post(
            name: 'post_property', 
            uriTemplate: '/properties', 
            controller: PropertyCreation::class
        )
    ]
)]
class Property
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['r-property'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['r-property', 'w-property'])]
    private ?string $name = null;

    #[ORM\Column(length: 125, unique: true)]
    #[Groups(['r-property'])]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Human::class, mappedBy: 'properties')]
    #[Groups(['r-property'])]
    private Collection $humans;

    #[ORM\ManyToMany(targetEntity: Cat::class, mappedBy: 'properties')]
    #[Groups(['r-property'])]
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
