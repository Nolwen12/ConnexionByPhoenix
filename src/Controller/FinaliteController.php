<?php

namespace App\Controller;

use App\Entity\Finalite;
use App\Form\FinaliteType;
use App\Repository\FinaliteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/finalite')]
final class FinaliteController extends AbstractController
{
    #[Route(name: 'app_finalite_index', methods: ['GET'])]
    public function index(FinaliteRepository $finaliteRepository): Response
    {
        return $this->render('finalite/index.html.twig', [
            'finalites' => $finaliteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_finalite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $finalite = new Finalite();
        $form = $this->createForm(FinaliteType::class, $finalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($finalite);
            $entityManager->flush();

            return $this->redirectToRoute('app_finalite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('finalite/new.html.twig', [
            'finalite' => $finalite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_finalite_show', methods: ['GET'])]
    public function show(Finalite $finalite): Response
    {
        return $this->render('finalite/show.html.twig', [
            'finalite' => $finalite,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_finalite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Finalite $finalite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FinaliteType::class, $finalite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_finalite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('finalite/edit.html.twig', [
            'finalite' => $finalite,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_finalite_delete', methods: ['POST'])]
    public function delete(Request $request, Finalite $finalite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$finalite->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($finalite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_finalite_index', [], Response::HTTP_SEE_OTHER);
    }
}
