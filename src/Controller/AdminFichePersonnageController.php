<?php

namespace App\Controller;

use App\Entity\FichePersonnage;
use App\Form\FichePersonnageType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\FichePersonnageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fiche/personnage')]
class AdminFichePersonnageController extends AbstractController
{
    #[Route('/', name: 'admin_fiche_personnage_index', methods: ['GET'])]
    public function index(FichePersonnageRepository $fichePersonnageRepository): Response
    {
        return $this->render('admin_fiche_personnage/index.html.twig', [
            'fiche_personnages' => $fichePersonnageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_fiche_personnage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnage = new FichePersonnage();
        $form = $this->createForm(FichePersonnageType::class, $fichePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('fichePersonnage_pictures_directory'), $nomImg); // déplace l'Img 1 dans le dossier adéquat
            $fichePersonnage ->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($fichePersonnage); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La Fiche Personnage bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_fiche_personnage_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_fiche_personnage/new.html.twig', [
            'fiche_personnage ' =>  $fichePersonnage ,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_show', methods: ['GET'])]
    public function show(FichePersonnage $fichePersonnage): Response
    {
        return $this->render('admin_fiche_personnage/show.html.twig', [
            'fiche_personnage' => $fichePersonnage,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_fiche_personnage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FichePersonnageRepository $fichePersonnageRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnage = $fichePersonnageRepository->find($id);
        $form = $this->createForm(FichePersonnageType::class, $fichePersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $fichePersonnage->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('fichePersonnage_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $fichePersonnage->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('fichePersonnage_pictures_directory'), $nomOldImg); // upload
            } else {
                $fichePersonnage->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($fichePersonnage);
            $manager->flush();
            $this->addFlash('success', 'La Fiche Personnage LR a bien été modifiée');
            return $this->redirectToRoute('admin_fiche_personnage_index');
        }
        return $this->render('admin_fiche_personnage/edit.html.twig', [
            'fiche_personnage' => $fichePersonnage,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_delete', methods: ['POST'])]
    public function delete(FichePersonnageRepository $fichePersonnageRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo =  $fichePersonnageRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('fichePersonnage_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'La Fiche Personnage LR a bien été supprimée');
        return $this->redirectToRoute('admin_fiche_personnage_index');
    }
}
