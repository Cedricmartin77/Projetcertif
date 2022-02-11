<?php

namespace App\Controller;

use App\Entity\EncyclopedieDesPersonnages;
use App\Repository\FichePersonnageRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FrontPageNouveauPersoRepository;
use App\Repository\FrontPageNouveauPersosRepository;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FichePersonnageRepository $fichePersonnageRepository,FrontPageNouveauPersoRepository $frontPageNouveauPersoRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'front_page_nouveau_perso' => $frontPageNouveauPersoRepository->findBy(
                array(),
                array('id'=> 'ASC'),
                15,
            )
        ]);
    }
}