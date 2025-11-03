<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
#[ORM\Table(name: '`tbl_game`')]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'game', cascade: ['persist', 'remove'])]
    private ?Team $launchedBy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLaunchedBy(): ?Team
    {
        return $this->launchedBy;
    }

    public function setLaunchedBy(?Team $launchedBy): static
    {
        $this->launchedBy = $launchedBy;

        return $this;
    }
}
