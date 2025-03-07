<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Voiture;
use App\Enum\GearboxChoice;
use App\Form\VoitureType;
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

    // delete a vehicle 
    #[Route('/voiture/{id}/supprimer', name: 'app_voiture_delete')]
    public function remove(int $id, VoitureRepository $respository, EntityManagerInterface $entityManager): Response
    {
       
        $voiture = $respository->find($id);
        
        if(!$voiture){
            return $this->redirectToRoute('app_accueil');
        }

        $entityManager->remove($voiture); // delete the vehicle
        $entityManager->flush();
        
        return $this->redirectToRoute('app_accueil');
    }

    // add a vehicle 
    #[Route('/voiture/ajouter', name: 'app_voiture_add')]
   public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        // Create an instance of our form filled with the data passed as the second parameter.
        $form = $this->createForm(VoitureType::class, $voiture);
       
        // Pass the submitted information in the form (if the form has been filled) and update the data inside it.
        $form->handleRequest($request);
        
        //Check if the form has been submitted and is validated
        if($form->isSubmitted() && $form->isValid()){ // use the constraints defined in the Voiture entity

            $entityManager->persist($voiture); // add the vehicle
            $entityManager->flush(); // save the vehicle in the database
            $this->addFlash('success', 'Votre nouvelle voiture a bien été ajoutée !');
            return $this->redirectToRoute('app_show', ['id' => $voiture->getId()]);
        }
        
        return $this->render('voitures/add.html.twig', [
            'form' => $form,
        ]);

        
        
    }

}