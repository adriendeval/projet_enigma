<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: '`tbl_game`')]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $welcomeMsg = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $welcomeImg = null;

    #[ORM\ManyToOne(inversedBy: 'games')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, Enigma>
     */
    #[ORM\OneToMany(targetEntity: Enigma::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    private Collection $enigmas;

    #[ORM\OneToOne(mappedBy: 'game', cascade: ['persist', 'remove'])]
    private ?Setting $setting = null;

    /**
     * @var Collection<int, Team>
     */
    #[ORM\OneToMany(targetEntity: Team::class, mappedBy: 'game', cascade: ['persist', 'remove'])]
    private Collection $teams;

    public function __construct()
    {
        $this->enigmas = new ArrayCollection();
        $this->teams = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getWelcomeMsg(): ?string
    {
        return $this->welcomeMsg;
    }

    public function setWelcomeMsg(?string $welcomeMsg): static
    {
        $this->welcomeMsg = $welcomeMsg;

        return $this;
    }

    public function getWelcomeImg(): ?string
    {
        return $this->welcomeImg;
    }

    public function setWelcomeImg(?string $welcomeImg): static
    {
        $this->welcomeImg = $welcomeImg;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Enigma>
     */
    public function getEnigmas(): Collection
    {
        return $this->enigmas;
    }

    public function addEnigma(Enigma $enigma): static
    {
        if (!$this->enigmas->contains($enigma)) {
            $this->enigmas->add($enigma);
            $enigma->setGame($this);
        }

        return $this;
    }

    public function removeEnigma(Enigma $enigma): static
    {
        if ($this->enigmas->removeElement($enigma)) {
            // set the owning side to null (unless already changed)
            if ($enigma->getGame() === $this) {
                $enigma->setGame(null);
            }
        }

        return $this;
    }

    public function getSetting(): ?Setting
    {
        return $this->setting;
    }

    public function setSetting(?Setting $setting): static
    {
        // unset the owning side of the relation if necessary
        if ($setting === null && $this->setting !== null) {
            $this->setting->setGame(null);
        }

        // set the owning side of the relation if necessary
        if ($setting !== null && $setting->getGame() !== $this) {
            $setting->setGame($this);
        }

        $this->setting = $setting;

        return $this;
    }

    /**
     * @return Collection<int, Team>
     */
    public function getTeams(): Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team): static
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setGame($this);
        }

        return $this;
    }

    public function removeTeam(Team $team): static
    {
        if ($this->teams->removeElement($team)) {
            // set the owning side to null (unless already changed)
            if ($team->getGame() === $this) {
                $team->setGame(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? '';
    }
}
