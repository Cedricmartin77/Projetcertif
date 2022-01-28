<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\FichePersonnageUrActiveSkill;
use Symfony\Component\HttpFoundation\Request;
use App\Form\FichePersonnageUrActiveSkillType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FichePersonnageUrActiveSkillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fiche/personnage/ur/active/skill')]
class AdminFichePersonnageUrActiveSkillController extends AbstractController
{
    #[Route('/', name: 'admin_fiche_personnage_ur_active_skill_index', methods: ['GET'])]
    public function index(FichePersonnageUrActiveSkillRepository $fichePersonnageUrActiveSkillRepository): Response
    {
        return $this->render('admin_fiche_personnage_ur_active_skill/index.html.twig', [
            'fiche_personnage_ur_active_skills' => $fichePersonnageUrActiveSkillRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_fiche_personnage_ur_active_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageUrActiveSkill = new FichePersonnageUrActiveSkill();
        $form = $this->createForm(FichePersonnageUrActiveSkillType::class, $fichePersonnageUrActiveSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('fichePersonnageUrActiveSkill_pictures_directory'), $nomImg); // déplace l'Img 1 dans le dossier adéquat
            $fichePersonnageUrActiveSkill ->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($fichePersonnageUrActiveSkill); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La Fiche Personnage Ur bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_fiche_personnage_ur_active_skill_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_fiche_personnage_ur_active_skill/new.html.twig', [
            'fiche_personnage_ur_active_skill ' => $fichePersonnageUrActiveSkill ,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ur_active_skill_show', methods: ['GET'])]
    public function show(FichePersonnageUrActiveSkill $fichePersonnageUrActiveSkill): Response
    {
        return $this->render('admin_fiche_personnage_ur_active_skill/show.html.twig', [
            'fiche_personnage_ur_active_skill' => $fichePersonnageUrActiveSkill,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_fiche_personnage_ur_active_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FichePersonnageUrActiveSkillRepository $fichePersonnageUrActiveSkillRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageUrActiveSkill = $fichePersonnageUrActiveSkillRepository->find($id);
        $form = $this->createForm(FichePersonnageUrActiveSkillType::class, $fichePersonnageUrActiveSkill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg =  $fichePersonnageUrActiveSkill->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('fichePersonnageUrActiveSkill_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $fichePersonnageUrActiveSkill->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('fichePersonnageUrActiveSkill_pictures_directory'), $nomOldImg); // upload
            } else {
                $fichePersonnageUrActiveSkill->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($fichePersonnageUrActiveSkill);
            $manager->flush();
            $this->addFlash('success', 'La Fiche Personnage Ur a bien été modifiée');
            return $this->redirectToRoute('admin_fiche_personnage_ur_active_skill_index');
        }
        return $this->render('admin_fiche_personnage_ur_active_skill/edit.html.twig', [
            'fiche_personnage_ur_active_skill' =>  $fichePersonnageUrActiveSkill,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ur_active_skill_delete', methods: ['POST'])]
    public function delete(FichePersonnageUrActiveSkillRepository $fichePersonnageUrActiveSkillRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo = $fichePersonnageUrActiveSkillRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('fichePersonnageUrActiveSkill_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'La Fiche Personnage Ur a bien été supprimée');
        return $this->redirectToRoute('admin_fiche_personnage_ur_active_skill_index');
    }
}
