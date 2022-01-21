<?php

namespace App\Controller;

use App\Entity\FichePersonnageSsr;
use App\Form\FichePersonnageSsr1Type;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FichePersonnageSsrRepository;
use App\Repository\EncyclopedieDuPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fiche/personnage/ssr')]
class FichePersonnageSsrController extends AbstractController
{
   
    #[Route('/fiche/personnage/ssr/{id}', name: 'fiche_personnage_ssr', methods: ['GET'])]
    public function show(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->find($id);
        $fichePersonnageSsr = $personnages->getFichePersonnageSsrs();
        return $this->render('fiche_personnage_ssr/show.html.twig', [
            'fiche_personnage_ssr' => $fichePersonnageSsr,
            'personnages' => $personnages
        ]);
    }

}
