<?php

namespace App\Controller;

use App\Entity\FichePersonnageUr;
use App\Form\FichePersonnageUrType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\FichePersonnageUrRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fiche/personnage/ur')]
class AdminFichePersonnageUrController extends AbstractController
{
    #[Route('/', name: 'admin_fiche_personnage_ur_index', methods: ['GET'])]
    public function index(FichePersonnageUrRepository $fichePersonnageUrRepository): Response
    {
        return $this->render('admin_fiche_personnage_ur/index.html.twig', [
            'fiche_personnage_urs' => $fichePersonnageUrRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_fiche_personnage_ur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageUr = new FichePersonnageUr();
        $form = $this->createForm(FichePersonnageUrType::class, $fichePersonnageUr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('fichePersonnageUr_pictures_directory'), $nomImg); // déplace l'Img 1 dans le dossier adéquat
            $fichePersonnageUr ->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($fichePersonnageUr ); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La Fiche Personnage Ur bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_fiche_personnage_ur_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_fiche_personnage_ur/new.html.twig', [
            'fiche_personnage_ur ' => $fichePersonnageUr ,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ur_show', methods: ['GET'])]
    public function show(FichePersonnageUr $fichePersonnageUr): Response
    {
        return $this->render('admin_fiche_personnage_ur/show.html.twig', [
            'fiche_personnage_ur' => $fichePersonnageUr,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_fiche_personnage_ur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FichePersonnageUrRepository $fichePersonnageUrRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageUr = $fichePersonnageUrRepository->find($id);
        $form = $this->createForm(FichePersonnageUrType::class, $fichePersonnageUr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $fichePersonnageUr->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('fichePersonnageUr_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $fichePersonnageUr->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('fichePersonnageUr_pictures_directory'), $nomOldImg); // upload
            } else {
                $fichePersonnageUr->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($fichePersonnageUr);
            $manager->flush();
            $this->addFlash('success', 'La Fiche Personnage Ur a bien été modifiée');
            return $this->redirectToRoute('admin_fiche_personnage_ur_index');
        }
        return $this->render('admin_fiche_personnage_ur/edit.html.twig', [
            'fiche_personnage_ur' => $fichePersonnageUr,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ur_delete', methods: ['POST'])]
    public function delete(Request $request, FichePersonnageUrRepository $fichePersonnageUrRepository,  int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo = $fichePersonnageUrRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('fichePersonnageUr_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'La Fiche Personnage Ur a bien été supprimée');
        return $this->redirectToRoute('admin_fiche_personnage_ur_index');
    }
}
