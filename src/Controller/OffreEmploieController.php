<?php

namespace App\Controller;

use App\Entity\OffreEmploie;
use App\Form\OffreEmploieType;
use App\Repository\OffreEmploieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/offre/emploie')]
final class OffreEmploieController extends AbstractController
{
    #[Route(name: 'app_offre_emploie_index', methods: ['GET'])]
    public function index(OffreEmploieRepository $offreEmploieRepository): Response
    {
        return $this->render('offre_emploie/index.html.twig', [
            'offre_emploies' => $offreEmploieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_offre_emploie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offreEmploie = new OffreEmploie();
        $form = $this->createForm(OffreEmploieType::class, $offreEmploie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offreEmploie);
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_emploie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_emploie/new.html.twig', [
            'offre_emploie' => $offreEmploie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_emploie_show', methods: ['GET'])]
    public function show(OffreEmploie $offreEmploie): Response
    {
        return $this->render('offre_emploie/show.html.twig', [
            'offre_emploie' => $offreEmploie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_offre_emploie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OffreEmploie $offreEmploie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffreEmploieType::class, $offreEmploie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offre_emploie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('offre_emploie/edit.html.twig', [
            'offre_emploie' => $offreEmploie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offre_emploie_delete', methods: ['POST'])]
    public function delete(Request $request, OffreEmploie $offreEmploie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offreEmploie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($offreEmploie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offre_emploie_index', [], Response::HTTP_SEE_OTHER);
    }
}
