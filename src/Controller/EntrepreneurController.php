<?php

namespace App\Controller;

use App\Entity\Collaboration;
use App\Repository\AppelRepository;
use App\Repository\BanqueRepository;
use App\Repository\CollaborationRepository;
use App\Repository\LieuRepository;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Entreprise;
use App\Repository\EntrepriseRepository;

#[Route('/entrepreneur')]
final class EntrepreneurController extends AbstractController
{
    #[Route(name: 'app_entrepreneur')]
    public function index(EntrepriseRepository $entrepriseRepository): Response
    {
        return $this->render('entrepreneur/index.html.twig', [
            'controller_name' => 'EntrepreneurController',
            'entreprises' => $entrepriseRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_entrepreneur_show', methods: ['GET'])]
    public function showEntreprise(Entreprise $entreprise, MessageRepository $messageRepository, CollaborationRepository $collaborationRepository, EntityManagerInterface $em): Response
    {
        //$entrepriseConnectee = $this->getUser()->getEntreprise();
        $entrepriseConnectee = $entreprise->getUser()->getEntreprise();

        // Cherche collaboration entre les deux entreprises
        $collaboration = $collaborationRepository->findOneBy([
            'entreprise1' => $entrepriseConnectee,
            'entreprise2' => $entreprise
        ]);

        $nbMessages = 0;

        if ($collaboration) {
            $nbMessages = $messageRepository->countByCollaboration($collaboration);
        }
        else
        {
            $collaboration = new Collaboration();
            $collaboration->setEntreprise1($entrepriseConnectee);
            $collaboration->setEntreprise2($entreprise);
            $collaboration->setCreatedAt(new \DateTimeImmutable());

            $em->persist($collaboration);
            $em->flush();
        }

        return $this->render('entrepreneur/entreprise.html.twig', [
            'entreprise' => $entreprise,
            'nbMessages' => $nbMessages,
        ]);
    }

    #[Route('/message/{id}', name: 'app_message')]
    public function indexMessage(MessageRepository $message, Entreprise $entreprise): Response
    {
        return $this->render('entrepreneur/message.html.twig', [
            'message' => $message->findAll(),
            'entreprise' => $entreprise,
        ]);
    }

    #[Route('/appel/{id}', name: 'app_appel')]
    public function indexMAppel(AppelRepository $appel, Entreprise $entreprise): Response
    {
        return $this->render('entrepreneur/appel.html.twig', [
            'appel' => $appel->findAll(),
            'entreprise' => $entreprise,
        ]);
    }

    #[Route('/lieu/{id}', name: 'app_lieu')]
    public function indexLieu(LieuRepository $lieu, Entreprise $entreprise): Response
    {
        return $this->render('entrepreneur/lieu.html.twig', [
            'lieu' => $lieu->findAll(),
            'entreprise' => $entreprise,
        ]);
    }

    #[Route('/banque/{id}', name: 'app_banque')]
    public function indexBanque(BanqueRepository $banque, Entreprise $entreprise): Response
    {
        return $this->render('entrepreneur/banque.html.twig', [
            'banque' => $banque->findAll(),
            'entreprise' => $entreprise,
        ]);
    }
}
