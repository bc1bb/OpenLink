<?php

namespace App\Entity;

use App\Repository\LinksRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LinksRepository::class)]
class Links
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 128)]
    private ?string $original = null;

    #[ORM\Column(length: 11)]
    private ?string $shorten = null;

    #[ORM\Column]
    private ?int $creation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOriginal(): ?string
    {
        return $this->original;
    }

    public function setOriginal(string $original): static
    {
        $this->original = $original;

        return $this;
    }

    public function getShorten(): ?string
    {
        return $this->shorten;
    }

    public function setShorten(string $shorten): static
    {
        $this->shorten = $shorten;

        return $this;
    }

    public function getCreation(): ?int
    {
        return $this->creation;
    }

    public function setCreation(int $creation): static
    {
        $this->creation = $creation;

        return $this;
    }
}
