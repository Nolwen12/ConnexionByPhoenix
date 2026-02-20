<?php

namespace App\Entity;

use App\Repository\CompetenceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competence
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, DemandeurCompetence>
     */
    #[ORM\OneToMany(targetEntity: DemandeurCompetence::class, mappedBy: 'competence')]
    private Collection $demandeurCompetences;

    public function __construct()
    {
        $this->demandeurCompetences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, DemandeurCompetence>
     */
    public function getDemandeurCompetences(): Collection
    {
        return $this->demandeurCompetences;
    }

    public function addDemandeurCompetence(DemandeurCompetence $demandeurCompetence): static
    {
        if (!$this->demandeurCompetences->contains($demandeurCompetence)) {
            $this->demandeurCompetences->add($demandeurCompetence);
            $demandeurCompetence->setCompetence($this);
        }

        return $this;
    }

    public function removeDemandeurCompetence(DemandeurCompetence $demandeurCompetence): static
    {
        if ($this->demandeurCompetences->removeElement($demandeurCompetence)) {
            // set the owning side to null (unless already changed)
            if ($demandeurCompetence->getCompetence() === $this) {
                $demandeurCompetence->setCompetence(null);
            }
        }

        return $this;
    }
}
