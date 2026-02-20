<?php

namespace App\Entity;

use App\Repository\BanqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BanqueRepository::class)]
class Banque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $cp = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    /**
     * @var Collection<int, PropositionBanque>
     */
    #[ORM\OneToMany(targetEntity: PropositionBanque::class, mappedBy: 'banque')]
    private Collection $propositionBanques;

    public function __construct()
    {
        $this->propositionBanques = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCp(): ?string
    {
        return $this->cp;
    }

    public function setCp(string $cp): static
    {
        $this->cp = $cp;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, PropositionBanque>
     */
    public function getPropositionBanques(): Collection
    {
        return $this->propositionBanques;
    }

    public function addPropositionBanque(PropositionBanque $propositionBanque): static
    {
        if (!$this->propositionBanques->contains($propositionBanque)) {
            $this->propositionBanques->add($propositionBanque);
            $propositionBanque->setBanque($this);
        }

        return $this;
    }

    public function removePropositionBanque(PropositionBanque $propositionBanque): static
    {
        if ($this->propositionBanques->removeElement($propositionBanque)) {
            // set the owning side to null (unless already changed)
            if ($propositionBanque->getBanque() === $this) {
                $propositionBanque->setBanque(null);
            }
        }

        return $this;
    }
}
