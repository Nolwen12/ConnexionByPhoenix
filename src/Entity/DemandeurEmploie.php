<?php

namespace App\Entity;

use App\Repository\DemandeurEmploieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeurEmploieRepository::class)]
class DemandeurEmploie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $cv = null;

    /**
     * @var Collection<int, DemandeOffre>
     */
    #[ORM\OneToMany(targetEntity: DemandeOffre::class, mappedBy: 'demandeur_emploie')]
    private Collection $demandeOffres;

    /**
     * @var Collection<int, DemandeurCompetence>
     */
    #[ORM\OneToMany(targetEntity: DemandeurCompetence::class, mappedBy: 'demandeur_emploie')]
    private Collection $demandeurCompetences;

    /**
     * @var Collection<int, Experience>
     */
    #[ORM\OneToMany(targetEntity: Experience::class, mappedBy: 'demandeur_emploie')]
    private Collection $experiences;

    /**
     * @var Collection<int, Formation>
     */
    #[ORM\OneToMany(targetEntity: Formation::class, mappedBy: 'demandeur_emploie')]
    private Collection $formations;

    #[ORM\OneToOne(inversedBy: 'demandeurEmploie', cascade: ['persist', 'remove'])]
    private ?Users $user = null;

    public function __construct()
    {
        $this->demandeOffres = new ArrayCollection();
        $this->demandeurCompetences = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->formations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): static
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * @return Collection<int, DemandeOffre>
     */
    public function getDemandeOffres(): Collection
    {
        return $this->demandeOffres;
    }

    public function addDemandeOffre(DemandeOffre $demandeOffre): static
    {
        if (!$this->demandeOffres->contains($demandeOffre)) {
            $this->demandeOffres->add($demandeOffre);
            $demandeOffre->setDemandeurEmploie($this);
        }

        return $this;
    }

    public function removeDemandeOffre(DemandeOffre $demandeOffre): static
    {
        if ($this->demandeOffres->removeElement($demandeOffre)) {
            // set the owning side to null (unless already changed)
            if ($demandeOffre->getDemandeurEmploie() === $this) {
                $demandeOffre->setDemandeurEmploie(null);
            }
        }

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
            $demandeurCompetence->setDemandeurEmploie($this);
        }

        return $this;
    }

    public function removeDemandeurCompetence(DemandeurCompetence $demandeurCompetence): static
    {
        if ($this->demandeurCompetences->removeElement($demandeurCompetence)) {
            // set the owning side to null (unless already changed)
            if ($demandeurCompetence->getDemandeurEmploie() === $this) {
                $demandeurCompetence->setDemandeurEmploie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Experience>
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): static
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences->add($experience);
            $experience->setDemandeurEmploie($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getDemandeurEmploie() === $this) {
                $experience->setDemandeurEmploie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormations(): Collection
    {
        return $this->formations;
    }

    public function addFormation(Formation $formation): static
    {
        if (!$this->formations->contains($formation)) {
            $this->formations->add($formation);
            $formation->setDemandeurEmploie($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): static
    {
        if ($this->formations->removeElement($formation)) {
            // set the owning side to null (unless already changed)
            if ($formation->getDemandeurEmploie() === $this) {
                $formation->setDemandeurEmploie(null);
            }
        }

        return $this;
    }

    public function getUser(): ?Users
    {
        return $this->user;
    }

    public function setUser(?Users $user): static
    {
        $this->user = $user;

        return $this;
    }
}
