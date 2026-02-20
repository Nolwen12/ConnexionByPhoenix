<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RechercheEmploieController extends AbstractController
{
    #[Route('/recherche/emploie', name: 'app_recherche_emploie')]
    public function index(): Response
    {
        return $this->render('recherche_emploie/index.html.twig', [
            'controller_name' => 'RechercheEmploieController',
        ]);
    }
}
