<?php

namespace App\Controller;

use App\Entity\Thumbnail;
use App\Form\ThumbnailType;
use App\Repository\ThumbnailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/thumbnail')]
final class ThumbnailController extends AbstractController
{
    #[Route(name: 'app_thumbnail_index', methods: ['GET'])]
    public function index(ThumbnailRepository $thumbnailRepository): Response
    {
        return $this->render('thumbnail/index.html.twig', [
            'thumbnails' => $thumbnailRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_thumbnail_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $thumbnail = new Thumbnail();
        $form = $this->createForm(ThumbnailType::class, $thumbnail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($thumbnail);
            $entityManager->flush();

            return $this->redirectToRoute('app_thumbnail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('thumbnail/new.html.twig', [
            'thumbnail' => $thumbnail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_thumbnail_show', methods: ['GET'])]
    public function show(Thumbnail $thumbnail): Response
    {
        return $this->render('thumbnail/show.html.twig', [
            'thumbnail' => $thumbnail,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_thumbnail_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Thumbnail $thumbnail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ThumbnailType::class, $thumbnail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_thumbnail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('thumbnail/edit.html.twig', [
            'thumbnail' => $thumbnail,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_thumbnail_delete', methods: ['POST'])]
    public function delete(Request $request, Thumbnail $thumbnail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thumbnail->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($thumbnail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_thumbnail_index', [], Response::HTTP_SEE_OTHER);
    }
}
