<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageDeDonController extends AbstractController
{
    #[Route('/page/de/don', name: 'page_de_don')]
    public function index(): Response
    {
        return $this->render('page_de_don/index.html.twig', [ //index de la page de don
            'controller_name' => 'PageDeDonController',
        ]);
    }
}
