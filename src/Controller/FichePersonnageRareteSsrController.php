<?php

namespace App\Controller;

use App\Entity\FichePersonnageRareteSsr;
use App\Form\FichePersonnageRareteSsr1Type;
use App\Repository\FichePersonnageRareteSsrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/fiche/personnage/rarete/ssr')]
class FichePersonnageRareteSsrController extends AbstractController
{
    // #[Route('/', name: 'fiche_personnage_rarete_ssr_index', methods: ['GET'])]
    // public function index(FichePersonnageRareteSsrRepository $fichePersonnageRareteSsrRepository): Response
    // {
    //     return $this->render('fiche_personnage_rarete_ssr/index.html.twig', [
    //         'fiche_personnage_rarete_ssrs' => $fichePersonnageRareteSsrRepository->findAll(),
    //     ]);
    // }

    #[Route('/fiche/personnage/rarete/ssr/{id}', name: 'fiche_personnage_rarete_ssr', methods: ['GET'])]
    public function show(FichePersonnageRareteSsrRepository $fichePersonnageRareteSsrRepository, $id): Response
    {
        $fichePersonnageRareteSsr = $fichePersonnageRareteSsrRepository->find($id);
        $encyclopedieDuPersonnage = $fichePersonnageRareteSsr->getEncyclopediedupersonnage();
        return $this->render('fiche_personnage_rarete_ssr/show.html.twig', [
            'fiche_personnage_rarete_ssr' => $fichePersonnageRareteSsr,
            'encyclopedieDuPersonnage' => $encyclopedieDuPersonnage

        ]);
    }


  

}
