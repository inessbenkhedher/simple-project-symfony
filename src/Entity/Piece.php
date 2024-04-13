<?php

namespace App\Entity;

use App\Repository\PieceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PieceRepository::class)]
class Piece
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomPiece = null;

    #[ORM\Column(length: 255)]
    private ?string $quantite = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 3)]
    private ?string $unite = null;

    #[ORM\Column(length: 255)]
    private ?string $fournisseur = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false , onDelete: 'CASCADE')]
    private ?Montage $Montage = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPiece(): ?string
    {
        return $this->nomPiece;
    }

    public function setNomPiece(string $nomPiece): static
    {
        $this->nomPiece = $nomPiece;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): static
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getUnite(): ?string
    {
        return $this->unite;
    }

    public function setUnite(string $unite): static
    {
        $this->unite = $unite;

        return $this;
    }

    public function getFournisseur(): ?string
    {
        return $this->fournisseur;
    }

    public function setFournisseur(string $fournisseur): static
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    public function getMontage(): ?Montage
    {
        return $this->Montage;
    }

    public function setMontage(?Montage $Montage): static
    {
        $this->Montage = $Montage;

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
