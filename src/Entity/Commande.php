<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $date = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_paiement = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_acheteur = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdPaiement(): ?int
    {
        return $this->id_paiement;
    }

    public function setIdPaiement(?int $id_paiement): self
    {
        $this->id_paiement = $id_paiement;

        return $this;
    }

    public function getIdAcheteur(): ?int
    {
        return $this->id_acheteur;
    }

    public function setIdAcheteur(?int $id_acheteur): self
    {
        $this->id_acheteur = $id_acheteur;

        return $this;
    }
}
