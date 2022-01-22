<?php

namespace App\Controller;

use App\Entity\EncyclopedieDesPersonnages;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FrontPageNouveauPersosRepository;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'encyclopedie_des_personnages' => $encyclopedieDesPersonnagesRepository->findBy(
                array(),
                array('id'=> 'DESC'),
                6,
                0
            )
        ]);
    }
}
