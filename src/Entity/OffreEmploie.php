<?php

namespace App\Entity;

use App\Repository\OffreEmploieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreEmploieRepository::class)]
class OffreEmploie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $mission = null;

    #[ORM\Column(length: 255)]
    private ?string $profil_rechercher = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lieu = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $info = null;

    #[ORM\ManyToOne(inversedBy: 'offreEmploies')]
    private ?TypeEmploie $type_emploie = null;

    #[ORM\ManyToOne(inversedBy: 'offreEmploies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $entreprise = null;

    /**
     * @var Collection<int, DemandeOffre>
     */
    #[ORM\OneToMany(targetEntity: DemandeOffre::class, mappedBy: 'offre_emploie')]
    private Collection $demandeOffres;

    public function __construct()
    {
        $this->Type_emploie = new ArrayCollection();
        $this->demandeOffres = new ArrayCollection();
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

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(string $mission): static
    {
        $this->mission = $mission;

        return $this;
    }

    public function getProfilRechercher(): ?string
    {
        return $this->profil_rechercher;
    }

    public function setProfilRechercher(string $profil_rechercher): static
    {
        $this->profil_rechercher = $profil_rechercher;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(?string $lieu): static
    {
        $this->lieu = $lieu;

        return $this;
    }

    public function getInfo(): ?string
    {
        return $this->info;
    }

    public function setInfo(?string $info): static
    {
        $this->info = $info;

        return $this;
    }

    public function getTypeEmploie(): ?TypeEmploie
    {
        return $this->type_emploie;
    }

    public function setTypeEmploie(?TypeEmploie $type_emploie): static
    {
        $this->type_emploie = $type_emploie;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): static
    {
        $this->entreprise = $entreprise;

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
            $demandeOffre->setOffreEmploie($this);
        }

        return $this;
    }

    public function removeDemandeOffre(DemandeOffre $demandeOffre): static
    {
        if ($this->demandeOffres->removeElement($demandeOffre)) {
            // set the owning side to null (unless already changed)
            if ($demandeOffre->getOffreEmploie() === $this) {
                $demandeOffre->setOffreEmploie(null);
            }
        }

        return $this;
    }
}
