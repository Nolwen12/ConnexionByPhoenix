<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $nationalite = null;

    #[ORM\Column(length: 255)]
    private ?string $activite = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $champs_action = null;

    /**
     * @var Collection<int, OffreEmploie>
     */
    #[ORM\OneToMany(targetEntity: OffreEmploie::class, mappedBy: 'entreprise')]
    private Collection $offreEmploies;

    /**
     * @var Collection<int, Collaboration>
     */
    #[ORM\OneToMany(targetEntity: Collaboration::class, mappedBy: 'entreprise1')]
    private Collection $collaborations1;

    /**
     * @var Collection<int, Collaboration>
     */
    #[ORM\OneToMany(targetEntity: Collaboration::class, mappedBy: 'entreprise2')]
    private Collection $collaborations2;

    /**
     * @var Collection<int, Finalite>
     */
    #[ORM\OneToMany(targetEntity: Finalite::class, mappedBy: 'entreprise')]
    private Collection $finalites;

    /**
     * @var Collection<int, Ressource>
     */
    #[ORM\OneToMany(targetEntity: Ressource::class, mappedBy: 'entreprise')]
    private Collection $ressources;

    /**
     * @var Collection<int, Secteur>
     */
    #[ORM\OneToMany(targetEntity: Secteur::class, mappedBy: 'entreprise')]
    private Collection $secteurs;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?StatutEntreprise $statut = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TailleEntreprise $taille = null;

    #[ORM\ManyToOne(inversedBy: 'entreprises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SecteurActivite $secteur_activite = null;

    #[ORM\OneToOne(inversedBy: 'entreprise', cascade: ['persist', 'remove'])]
    private ?Users $user = null;

    public function __construct()
    {
        $this->offreEmploies = new ArrayCollection();
        $this->collaborations1 = new ArrayCollection();
        $this->collaborations2 = new ArrayCollection();
        $this->finalites = new ArrayCollection();
        $this->ressources = new ArrayCollection();
        $this->secteurs = new ArrayCollection();
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

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): static
    {
        $this->activite = $activite;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getChampsAction(): ?string
    {
        return $this->champs_action;
    }

    public function setChampsAction(string $champs_action): static
    {
        $this->champs_action = $champs_action;

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
            $offreEmploie->setEntreprise($this);
        }

        return $this;
    }

    public function removeOffreEmploie(OffreEmploie $offreEmploie): static
    {
        if ($this->offreEmploies->removeElement($offreEmploie)) {
            // set the owning side to null (unless already changed)
            if ($offreEmploie->getEntreprise() === $this) {
                $offreEmploie->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Collaboration>
     */
    public function getCollaborations1(): Collection
    {
        return $this->collaborations1;
    }

    public function addCollaborations1(Collaboration $collaborations1): static
    {
        if (!$this->collaborations1->contains($collaborations1)) {
            $this->collaborations1->add($collaborations1);
            $collaborations1->setEntreprise1($this);
        }

        return $this;
    }

    public function removeCollaborations1(Collaboration $collaborations1): static
    {
        if ($this->collaborations1->removeElement($collaborations1)) {
            // set the owning side to null (unless already changed)
            if ($collaborations1->getEntreprise1() === $this) {
                $collaborations1->setEntreprise1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Collaboration>
     */
    public function getCollaborations2(): Collection
    {
        return $this->collaborations2;
    }

    public function addCollaborations2(Collaboration $collaborations2): static
    {
        if (!$this->collaborations2->contains($collaborations2)) {
            $this->collaborations2->add($collaborations2);
            $collaborations2->setEntreprise2($this);
        }

        return $this;
    }

    public function removeCollaborations2(Collaboration $collaborations2): static
    {
        if ($this->collaborations2->removeElement($collaborations2)) {
            // set the owning side to null (unless already changed)
            if ($collaborations2->getEntreprise2() === $this) {
                $collaborations2->setEntreprise2(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Finalite>
     */
    public function getFinalites(): Collection
    {
        return $this->finalites;
    }

    public function addFinalite(Finalite $finalite): static
    {
        if (!$this->finalites->contains($finalite)) {
            $this->finalites->add($finalite);
            $finalite->setEntreprise($this);
        }

        return $this;
    }

    public function removeFinalite(Finalite $finalite): static
    {
        if ($this->finalites->removeElement($finalite)) {
            // set the owning side to null (unless already changed)
            if ($finalite->getEntreprise() === $this) {
                $finalite->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Ressource>
     */
    public function getRessources(): Collection
    {
        return $this->ressources;
    }

    public function addRessource(Ressource $ressource): static
    {
        if (!$this->ressources->contains($ressource)) {
            $this->ressources->add($ressource);
            $ressource->setEntreprise($this);
        }

        return $this;
    }

    public function removeRessource(Ressource $ressource): static
    {
        if ($this->ressources->removeElement($ressource)) {
            // set the owning side to null (unless already changed)
            if ($ressource->getEntreprise() === $this) {
                $ressource->setEntreprise(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Secteur>
     */
    public function getSecteurs(): Collection
    {
        return $this->secteurs;
    }

    public function addSecteur(Secteur $secteur): static
    {
        if (!$this->secteurs->contains($secteur)) {
            $this->secteurs->add($secteur);
            $secteur->setEntreprise($this);
        }

        return $this;
    }

    public function removeSecteur(Secteur $secteur): static
    {
        if ($this->secteurs->removeElement($secteur)) {
            // set the owning side to null (unless already changed)
            if ($secteur->getEntreprise() === $this) {
                $secteur->setEntreprise(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?StatutEntreprise
    {
        return $this->statut;
    }

    public function setStatut(?StatutEntreprise $statut): static
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTaille(): ?TailleEntreprise
    {
        return $this->taille;
    }

    public function setTaille(?TailleEntreprise $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getSecteurActivite(): ?SecteurActivite
    {
        return $this->secteur_activite;
    }

    public function setSecteurActivite(?SecteurActivite $secteur_activite): static
    {
        $this->secteur_activite = $secteur_activite;

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
