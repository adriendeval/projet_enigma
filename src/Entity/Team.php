<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
#[ORM\Table(name: '`tbl_team`')]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATETIMETZ_MUTABLE)]
    private ?\DateTime $creationDate = null;

    #[ORM\OneToOne(mappedBy: 'launchedBy', cascade: ['persist', 'remove'])]
    private ?Game $game = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getCreationDate(): ?\DateTime
    {
        return $this->creationDate;
    }

    public function setCreationDate(\DateTime $creationDate): static
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): static
    {
        // unset the owning side of the relation if necessary
        if ($game === null && $this->game !== null) {
            $this->game->setLaunchedBy(null);
        }

        // set the owning side of the relation if necessary
        if ($game !== null && $game->getLaunchedBy() !== $this) {
            $game->setLaunchedBy($this);
        }

        $this->game = $game;

        return $this;
    }
}
