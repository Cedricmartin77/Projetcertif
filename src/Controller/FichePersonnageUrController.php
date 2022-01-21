<?php

namespace App\Controller;

use App\Entity\FichePersonnageUr;
use App\Form\FichePersonnageUr1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FichePersonnageUrRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fiche/personnage/ur')]
class FichePersonnageUrController extends AbstractController
{
    #[Route('/fiche/personnage/ur/{id}', name: 'fiche_personnage_ur', methods: ['GET'])]
    public function show(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->find($id);
        $fichePersonnageUr = $personnages->getFichePersonnageUrs();
        return $this->render('fiche_personnage_ur/show.html.twig', [
            'fiche_personnage_ur' => $fichePersonnageUr,
            'personnages' => $personnages
        ]);
    }
}
