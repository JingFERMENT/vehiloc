<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoituresController extends AbstractController
{
    // display all vehicles
    #[Route('/accueil', name: 'app_accueil')]
    public function index(VoitureRepository $respository): Response
    {
        $voitures = $respository->findAll();
        
        return $this->render('voitures/accueil.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    // display one vehicle
    #[Route('/voiture/{id}', name: 'app_show', requirements: ['id' => '\d+'])]
    public function show(VoitureRepository $respository,int $id, ): Response
    {
        $voiture = $respository->find($id);
        
        // if no vehicle correspond, redirect to the home page
        if(!$voiture){
            return $this->redirectToRoute('app_accueil');
        }
        return $this->render('voitures/voiture.html.twig', [
            'id' => $id,
            'voiture' => $voiture,
        ]);
    }

    // delete one vehicle 
    #[Route('/voiture/{id}/supprimer', name: 'app_voiture_delete')]
    public function delete(int $id, VoitureRepository $respository, EntityManagerInterface $entityManager): Response
    {
       
        $voiture = $respository->find($id);
        
        if(!$voiture){
            return $this->redirectToRoute('app_accueil');
        }

        $entityManager->remove($voiture); // remove method to delete the vehicle
        $entityManager->flush();
        
        return $this->redirectToRoute('app_accueil');
    }

    
}
