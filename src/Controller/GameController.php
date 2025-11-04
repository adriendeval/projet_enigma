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
        return $this->render('game/index.html.twig');
    }

    // Page qui affiche un message de création de la partie
    // Initialisation de currentIndex = 0           startTime = now()
    // Rediction vers app_game_play après 3 secondes
    #[Route('/game/start', name: 'app_game_start')]
    public function start(): Response
    {
        return $this->render('game/start.html.twig');
    }

    #[Route('/game/{id}/play', name: 'app_game_play')]
    public function play(int $id): Response
    {
        return $this->render('game/play.html.twig', [
            'game_id' => $id,
        ]);
    }

    #[Route('/game/{id}/submit', name: 'app_game_submit')]
    public function submit(int $id): Response
    {
        return $this->render('game/submit.html.twig', [
            'game_id' => $id,
        ]);
    }

    #[Route('/game/{id}/end', name: 'app_game_end')]
    public function end(int $id): Response
    {
        return $this->render('game/end.html.twig', [
            'game_id' => $id,
        ]);
    }
}
