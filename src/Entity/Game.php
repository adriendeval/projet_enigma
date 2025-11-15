<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: 'tbl_game')]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $welcomeMessage = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $welcomeImage = null;

    /**
     * @var Collection<int, Setting>
     */
    #[ORM\OneToMany(targetEntity: Setting::class, mappedBy: 'game')]
    private Collection $settings;

    public function __construct()
    {
        $this->settings = new ArrayCollection();
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

    public function getWelcomeMessage(): ?string
    {
        return $this->welcomeMessage;
    }

    public function setWelcomeMessage(?string $welcomeMessage): static
    {
        $this->welcomeMessage = $welcomeMessage;

        return $this;
    }

    public function getWelcomeImage(): ?string
    {
        return $this->welcomeImage;
    }

    public function setWelcomeImage(?string $welcomeImage): static
    {
        $this->welcomeImage = $welcomeImage;

        return $this;
    }

    /**
     * @return Collection<int, Setting>
     */
    public function getSettings(): Collection
    {
        return $this->settings;
    }

    public function addSetting(Setting $setting): static
    {
        if (!$this->settings->contains($setting)) {
            $this->settings->add($setting);
            $setting->setGame($this);
        }

        return $this;
    }

    public function removeSetting(Setting $setting): static
    {
        if ($this->settings->removeElement($setting)) {
            // set the owning side to null (unless already changed)
            if ($setting->getGame() === $this) {
                $setting->setGame(null);
            }
        }

        return $this;
    }
}
