<?php

namespace App\Controller;

use App\Entity\FichePersonnageLr;
use App\Form\FichePersonnageLr1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FichePersonnageLrRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fiche/personnage/lr')]
class FichePersonnageLrController extends AbstractController
{
    #[Route('/fiche/personnage/lr/{id}', name: 'fiche_personnage_lr', methods: ['GET'])]
    public function show(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->find($id);
        $fichePersonnageLr = $personnages->getFichePersonnageLrs();
        return $this->render('fiche_personnage_lr/show.html.twig', [
            'fiche_personnage_lr' => $fichePersonnageLr,
            'personnages' => $personnages
        ]);
    }
    
}
