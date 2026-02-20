<?php

namespace App\Controller;

use App\Entity\DemandeurEmploie;
use App\Form\DemandeurEmploieType;
use App\Repository\DemandeurEmploieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/demandeur/emploie')]
final class DemandeurEmploieController extends AbstractController
{
    #[Route(name: 'app_demandeur_emploie_index', methods: ['GET'])]
    public function index(DemandeurEmploieRepository $demandeurEmploieRepository): Response
    {
        return $this->render('demandeur_emploie/index.html.twig', [
            'demandeur_emploies' => $demandeurEmploieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demandeur_emploie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demandeurEmploie = new DemandeurEmploie();
        $form = $this->createForm(DemandeurEmploieType::class, $demandeurEmploie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demandeurEmploie);
            $entityManager->flush();

            return $this->redirectToRoute('app_demandeur_emploie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demandeur_emploie/new.html.twig', [
            'demandeur_emploie' => $demandeurEmploie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandeur_emploie_show', methods: ['GET'])]
    public function show(DemandeurEmploie $demandeurEmploie): Response
    {
        return $this->render('demandeur_emploie/show.html.twig', [
            'demandeur_emploie' => $demandeurEmploie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demandeur_emploie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DemandeurEmploie $demandeurEmploie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeurEmploieType::class, $demandeurEmploie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demandeur_emploie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demandeur_emploie/edit.html.twig', [
            'demandeur_emploie' => $demandeurEmploie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demandeur_emploie_delete', methods: ['POST'])]
    public function delete(Request $request, DemandeurEmploie $demandeurEmploie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demandeurEmploie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($demandeurEmploie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demandeur_emploie_index', [], Response::HTTP_SEE_OTHER);
    }
}
