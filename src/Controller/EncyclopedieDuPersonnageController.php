<?php

namespace App\Controller;

use App\Entity\EncyclopedieDuPersonnage;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\EncyclopedieDuPersonnage1Type;
use Knp\Component\Pager\PaginatorInterface;
use App\Repository\FichePersonnageRepository;
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
    public function show(Request $request, $id, EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, PaginatorInterface $paginator): Response
    {
        $fichesPersonnages = $encyclopedieDuPersonnageRepository->findEncyclopedieDuPersonnages($id);//sers a trouver l'encyclopédie du personnage via sont id 

        $fichesPersonnages = $paginator->paginate(
            $fichesPersonnages, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('encyclopedie_du_personnage/show.html.twig', [//index de l'encyclopédi du personnage
            'encyclopedieDuPersonnages' => $fichesPersonnages,

        ]);
    }
}