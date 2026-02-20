<?php

namespace App\Entity;

use App\Repository\TypeEmploieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeEmploieRepository::class)]
class TypeEmploie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $libelle = null;

    /**
     * @var Collection<int, OffreEmploie>
     */
    #[ORM\OneToMany(targetEntity: OffreEmploie::class, mappedBy: 'type_emploie')]
    private Collection $offreEmploies;

    /**
     * @var Collection<int, Experience>
     */
    #[ORM\OneToMany(targetEntity: Experience::class, mappedBy: 'type_emploie')]
    private Collection $experiences;

    public function __construct()
    {
        $this->offreEmploies = new ArrayCollection();
        $this->experiences = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): static
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection<int, OffreEmploie>
     */
    public function getOffreEmploies(): Collection
    {
        return $this->offreEmploies;
    }

    public function addOffreEmploie(OffreEmploie $offreEmploie): static
    {
        if (!$this->offreEmploies->contains($offreEmploie)) {
            $this->offreEmploies->add($offreEmploie);
            $offreEmploie->setTypeEmploie($this);
        }

        return $this;
    }

    public function removeOffreEmploie(OffreEmploie $offreEmploie): static
    {
        if ($this->offreEmploies->removeElement($offreEmploie)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploie->getTypeEmploie() === $this) {
                $offreEmploie->setTypeEmploie(null);
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
            $experience->setTypeEmploie($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): static
    {
        if ($this->experiences->removeElement($experience)) {
            // set the owning side to null (unless already changed)
            if ($experience->getTypeEmploie() === $this) {
                $experience->setTypeEmploie(null);
            }
        }

        return $this;
    }
}
