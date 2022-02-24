<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\EncyclopedieDesPersonnages;
use Knp\Component\Pager\PaginatorInterface;
use App\Form\EncyclopedieDesPersonnages1Type;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/encyclopedie/des/personnages')]
class EncyclopedieDesPersonnagesController extends AbstractController
{
    #[Route('/', name: 'encyclopedie_des_personnages', methods: ['GET'])]
    public function index(Request $request, EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository, PaginatorInterface $paginator): Response
    {
        $encyclopediedespersos = $encyclopedieDesPersonnagesRepository->findAll();

        $encyclopediedespersos = $paginator->paginate(
            $encyclopediedespersos, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('encyclopedie_des_personnages/index.html.twig', [
            'encyclopedie_des_personnages' => $encyclopediedespersos
        ]);
    }
}
