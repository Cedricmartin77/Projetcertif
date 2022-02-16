<?php

namespace App\Controller;

use App\Entity\FichePersonnage;
use App\Form\FichePersonnage1Type;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\FichePersonnageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fiche/personnage')]
class FichePersonnageController extends AbstractController
{
    #[Route('/{id}', name: 'fiche_personnage', methods: ['GET'])]
    public function show(FichePersonnageRepository $fichePersonnageRepository, int $id): Response
    {
        $personnages = $fichePersonnageRepository->find($id);
        return $this->render('fiche_personnage/show.html.twig', [
            'personnages' => $personnages
        ]);
    } 
}
