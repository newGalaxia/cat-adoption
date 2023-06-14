<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use App\Repository\ProposalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProposalRepository::class)]

#[ApiResource]
#[Post(validationContext: ['groups'=> ['Default', 'PostValidation' ]])]
class Proposal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'proposals')]
    private ?Cat $cat = null;

    #[ORM\ManyToOne(inversedBy: 'proposals')]
    private ?Human $human = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCat(): ?Cat
    {
        return $this->cat;
    }

    public function setCat(?Cat $cat): self
    {
        $this->cat = $cat;

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
}
