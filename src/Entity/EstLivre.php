<?php

namespace App\Entity;

use App\Repository\EstLivreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstLivreRepository::class)]
class EstLivre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_commande = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_livraison = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCommande(): ?int
    {
        return $this->id_commande;
    }

    public function setIdCommande(?int $id_commande): self
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    public function getIdLivraison(): ?int
    {
        return $this->id_livraison;
    }

    public function setIdLivraison(?int $id_livraison): self
    {
        $this->id_livraison = $id_livraison;

        return $this;
    }
}
