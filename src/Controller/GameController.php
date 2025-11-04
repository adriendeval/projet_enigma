<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GameController extends AbstractController
{
    // Page qui affiche le champ pour entrer un nom d'équipe + bouton pour démarrer la partie
    #[Route('/game', name: 'app_game')]
    public function index(): Response
    {
        return $this->render('game/index.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    // Page qui affiche un message de création de la partie
    // Initialisation de currentIndex = 0           startTime = now()
    // Rediction vers app_game_play après 3 secondes
    #[Route('/game/start', name: 'app_game_start')]
    public function start(): Response
    {
        return $this->render('game/start.html.twig', [
            'controller_name' => 'GameController',
        ]);
    }

    #[Route('/game/{id}/play', name: 'app_game_play')]
    public function play(int $id): Response
    {
        return $this->render('game/play.html.twig', [
            'controller_name' => 'GameController',
            'game_id' => $id,
        ]);
    }
}
