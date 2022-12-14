<?php

namespace App\Controller;

use App\Entity\Team;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(ManagerRegistry $doctrine): Response
    {
    $repository = $doctrine->getRepository(Team::class);
    $team = $repository->findAll();
    return $this->render('base.html.twig', compact('team'));
    }
}
    

