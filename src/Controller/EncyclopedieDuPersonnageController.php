<?php

namespace App\Controller;

use App\Entity\EncyclopedieDuPersonnage;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EncyclopedieDuPersonnage1Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/encyclopedie/du/personnage')]
class EncyclopedieDuPersonnageController extends AbstractController
{
    #[Route('/encyclopedie/du/personnage/{id}', name: 'encyclopedie_du_personnage', methods: ['GET'])]
    public function show(EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository, EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, $id): Response
    {
        $encyclopedieDuPersonnage = $encyclopedieDesPersonnagesRepository->find($id);
        $personnages = $encyclopedieDuPersonnageRepository->findBy(['encyclopedieDesPersonnages' => $id], ['id' => 'ASC']);
        return $this->render('encyclopedie_du_personnage/show.html.twig', [
            'encyclopedie_du_personnage' => $encyclopedieDuPersonnage,
            'personnages' => $personnages
        ]);
    }
}
