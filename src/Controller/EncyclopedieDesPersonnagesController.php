<?php

namespace App\Controller;

use App\Entity\EncyclopedieDesPersonnages;
use App\Form\EncyclopedieDesPersonnages1Type;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/encyclopedie/des/personnages')]
class EncyclopedieDesPersonnagesController extends AbstractController
{
    #[Route('/', name: 'encyclopedie_des_personnages', methods: ['GET'])]
    public function index(EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository): Response
    {
        $encyclopediedespersos = $encyclopedieDesPersonnagesRepository->findAll();
        return $this->render('encyclopedie_des_personnages/index.html.twig', [
            'encyclopedie_des_personnages' => $encyclopediedespersos
        ]);
    }
}
