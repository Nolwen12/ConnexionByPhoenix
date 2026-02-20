<?php

namespace App\Entity;

use App\Repository\DemandeurCompetenceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeurCompetenceRepository::class)]
class DemandeurCompetence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'demandeurCompetences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?DemandeurEmploie $demandeur_emploie = null;

    #[ORM\ManyToOne(inversedBy: 'demandeurCompetences')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Competence $competence = null;

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

    public function getCompetence(): ?Competence
    {
        return $this->competence;
    }

    public function setCompetence(?Competence $competence): static
    {
        $this->competence = $competence;

        return $this;
    }
}
