<?php

namespace App\Controller;

use App\Repository\FrontPageNouveauPersosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(FrontPageNouveauPersosRepository $frontPageNouveauPersoRepository): Response
    {
        $frontPageNouveauPerso = $frontPageNouveauPersoRepository->findBy([], ['id' => 'DESC'], 6);
        return $this->render('home/index.html.twig', [
            'frontPageNouveauPerso ' => $frontPageNouveauPerso ,
        ]);
    }
}
