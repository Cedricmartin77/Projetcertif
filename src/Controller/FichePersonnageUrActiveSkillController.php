<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\FichePersonnageUrActiveSkill;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\FichePersonnageUrActiveSkill1Type;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use App\Repository\FichePersonnageUrActiveSkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/fiche/personnage/ur/active/skill')]
class FichePersonnageUrActiveSkillController extends AbstractController
{
    #[Route('/{id}', name: 'fiche_personnage_ur_active_skill', methods: ['GET'])]
    public function show(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->find($id);
        $fichePersonnageUrActiveSkill = $personnages->getFichePersonnageUrActiveSkills();
        return $this->render('fiche_personnage_ur_active_skill/show.html.twig', [
            'fiche_personnage_ur_active_skill' => $fichePersonnageUrActiveSkill,
            'personnages' => $personnages
        ]);
    }
}
