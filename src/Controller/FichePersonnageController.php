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
    public function show(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->find($id);
        $fichePersonnage = $personnages->getFichePersonnages();
        return $this->render('fiche_personnage/show.html.twig', [
            'fiche_personnage' => $fichePersonnage,
            'personnages' => $personnages
        ]);
    } 
}
