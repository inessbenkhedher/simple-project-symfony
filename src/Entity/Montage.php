<?php

namespace App\Entity;

use App\Repository\MontageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: MontageRepository::class)]
class Montage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomMontage = null;

    #[ORM\Column(length: 255)]
    private ?string $client = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_At = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $cout = null;

   /**
 * @ORM\OneToMany(targetEntity=Piece::class, mappedBy="montage", cascade={"remove"})
 */
private $pieces;

#[ORM\Column(length: 255)]
private ?string $image = null;
 

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomMontage(): ?string
    {
        return $this->nomMontage;
    }

    public function setNomMontage(string $nomMontage): static
    {
        $this->nomMontage = $nomMontage;

        return $this;
    }

    public function getClient(): ?string
    {
        return $this->client;
    }

    public function setClient(string $client): static
    {
        $this->client = $client;

        return $this;
    }

   public function getCreatedAt(): ?\DateTimeInterface
{
    return $this->created_At;
}

public function setCreatedAt(\DateTimeInterface $created_At): static
{
    $this->created_At = $created_At;

    return $this;
}
    public function getCout(): ?string
    {
        return $this->cout;
    }

    public function setCout(string $cout): static
    {
        $this->cout = $cout;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }
}
