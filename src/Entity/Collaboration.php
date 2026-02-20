<?php

namespace App\Entity;

use App\Repository\CollaborationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CollaborationRepository::class)]
class Collaboration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    /**
     * @var Collection<int, Rencontre>
     */
    #[ORM\OneToMany(targetEntity: Rencontre::class, mappedBy: 'collaboration')]
    private Collection $rencontres;

    /**
     * @var Collection<int, Appel>
     */
    #[ORM\OneToMany(targetEntity: Appel::class, mappedBy: 'Collaboration')]
    private Collection $appels;

    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'collaboration')]
    private Collection $messages;

    /**
     * @var Collection<int, PropositionBanque>
     */
    #[ORM\OneToMany(targetEntity: PropositionBanque::class, mappedBy: 'collaboration')]
    private Collection $propositionBanques;

    #[ORM\ManyToOne(inversedBy: 'collaborations1')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $entreprise1 = null;

    #[ORM\ManyToOne(inversedBy: 'collaborations2')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprise $entreprise2 = null;

    public function __construct()
    {
        $this->rencontres = new ArrayCollection();
        $this->appels = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->propositionBanques = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontres(): Collection
    {
        return $this->rencontres;
    }

    public function addRencontre(Rencontre $rencontre): static
    {
        if (!$this->rencontres->contains($rencontre)) {
            $this->rencontres->add($rencontre);
            $rencontre->setCollaboration($this);
        }

        return $this;
    }

    public function removeRencontre(Rencontre $rencontre): static
    {
        if ($this->rencontres->removeElement($rencontre)) {
            // set the owning side to null (unless already changed)
            if ($rencontre->getCollaboration() === $this) {
                $rencontre->setCollaboration(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Appel>
     */
    public function getAppels(): Collection
    {
        return $this->appels;
    }

    public function addAppel(Appel $appel): static
    {
        if (!$this->appels->contains($appel)) {
            $this->appels->add($appel);
            $appel->setCollaboration($this);
        }

        return $this;
    }

    public function removeAppel(Appel $appel): static
    {
        if ($this->appels->removeElement($appel)) {
            // set the owning side to null (unless already changed)
            if ($appel->getCollaboration() === $this) {
                $appel->setCollaboration(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Message>
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): static
    {
        if (!$this->messages->contains($message)) {
            $this->messages->add($message);
            $message->setCollaboration($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): static
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getCollaboration() === $this) {
                $message->setCollaboration(null);
            }
        }

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
            $propositionBanque->setCollaboration($this);
        }

        return $this;
    }

    public function removePropositionBanque(PropositionBanque $propositionBanque): static
    {
        if ($this->propositionBanques->removeElement($propositionBanque)) {
            // set the owning side to null (unless already changed)
            if ($propositionBanque->getCollaboration() === $this) {
                $propositionBanque->setCollaboration(null);
            }
        }

        return $this;
    }

    public function getEntreprise1(): ?Entreprise
    {
        return $this->entreprise1;
    }

    public function setEntreprise1(?Entreprise $entreprise1): static
    {
        $this->entreprise1 = $entreprise1;

        return $this;
    }

    public function getEntreprise2(): ?Entreprise
    {
        return $this->entreprise2;
    }

    public function setEntreprise2(?Entreprise $entreprise2): static
    {
        $this->entreprise2 = $entreprise2;

        return $this;
    }
}
