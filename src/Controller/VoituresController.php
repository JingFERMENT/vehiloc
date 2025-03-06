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


    #[Route('/voiture/{id}', name: 'app_voiture', requirements: ['id' => '\d+'])]
    public function voiture(int $id, VoitureRepository $respository): Response
    {
        $voiture = $respository->find($id);
        
        if(!$voiture){
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('voitures/voiture.html.twig', [
            'id' => $id,
            'voiture' => $voiture,
        ]);
    }
    
}
