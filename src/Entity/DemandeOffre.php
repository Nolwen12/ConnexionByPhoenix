<?php

namespace App\Entity;

use App\Repository\DemandeOffreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeOffreRepository::class)]
class DemandeOffre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demandeOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DemandeurEmploie $demandeur_emploie = null;

    #[ORM\ManyToOne(inversedBy: 'demandeOffres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?OffreEmploie $offre_emploie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDemandeurEmploie(): ?DemandeurEmploie
    {
        return $this->demandeur_emploie;
    }

    public function setDemandeurEmploie(?DemandeurEmploie $demandeur_emploie): static
    {
        $this->demandeur_emploie = $demandeur_emploie;

        return $this;
    }

    public function getOffreEmploie(): ?OffreEmploie
    {
        return $this->offre_emploie;
    }

    public function setOffreEmploie(?OffreEmploie $offre_emploie): static
    {
        $this->offre_emploie = $offre_emploie;

        return $this;
    }
}
