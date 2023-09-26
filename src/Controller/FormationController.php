<?php

namespace App\Controller;

use App\Entity\Formation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormationController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/formations', name: 'formation_all')]
    public function list(): Response
    {
        $formationRepository = $this->entityManager->getRepository(Formation::class);
        $formations = $formationRepository->findAll();

        return $this->render('formation/all.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/formation/{slug}', name: 'formation_show')]
    public function show(?Formation $formation): Response
    {
        if (!$formation) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('formation/show.html.twig', [
            'formation'=>$formation,
        ]);
    }
}
