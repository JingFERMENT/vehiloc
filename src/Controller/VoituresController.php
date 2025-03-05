<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoituresController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(VoitureRepository $respository): Response
    {
        $voitures = $respository->findAll();
        
        return $this->render('voitures/accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }
}
