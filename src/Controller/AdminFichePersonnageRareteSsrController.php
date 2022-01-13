<?php

namespace App\Controller;

use App\Entity\FichePersonnageRareteSsr;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\FichePersonnageRareteSsrType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FichePersonnageRareteSsrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fiche/personnage/rarete/ssr')]
class AdminFichePersonnageRareteSsrController extends AbstractController
{
    #[Route('/', name: 'admin_fiche_personnage_rarete_ssr_index', methods: ['GET'])]
    public function index(FichePersonnageRareteSsrRepository $fichePersonnageRareteSsrRepository): Response
    {
        return $this->render('admin_fiche_personnage_rarete_ssr/index.html.twig', [
            'fiche_personnage_rarete_ssrs' => $fichePersonnageRareteSsrRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_fiche_personnage_rarete_ssr_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageRareteSsr = new FichePersonnageRareteSsr();
        $form = $this->createForm(FichePersonnageRareteSsrType::class, $fichePersonnageRareteSsr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-3.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('fichePersonnage_pictures_directory'), $nomImg); // déplace l'Img  dans le dossier adéquat
            $fichePersonnageRareteSsr->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($fichePersonnageRareteSsr); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La fiche personnage a bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_fiche_personnage_rarete_ssr_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_fiche_personnage_rarete_ssr/new.html.twig', [
            'fichePersonnageRareteSsr' => $fichePersonnageRareteSsr,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_rarete_ssr_show', methods: ['GET'])]
    public function show(FichePersonnageRareteSsr $fichePersonnageRareteSsr): Response
    {
        return $this->render('admin_fiche_personnage_rarete_ssr/show.html.twig', [
            'fiche_personnage_rarete_ssr' => $fichePersonnageRareteSsr,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_fiche_personnage_rarete_ssr_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FichePersonnageRareteSsrRepository $fichePersonnageRareteSsrRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageRareteSsr = $fichePersonnageRareteSsrRepository->find($id);
        $form = $this->createForm(FichePersonnageRareteSsrType::class, $fichePersonnageRareteSsr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $fichePersonnageRareteSsr->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('fichePersonnage_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $fichePersonnageRareteSsr->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('fichePersonnage_pictures_directory'), $nomOldImg); // upload
            } else {
                $fichePersonnageRareteSsr->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist( $fichePersonnageRareteSsr);
            $manager->flush();
            $this->addFlash('success', 'L\'encyclopédie des personnages bien été modifiée');
            return $this->redirectToRoute('admin_fiche_personnage_rare_ssr_index');
        }
        return $this->render('admin_fiche_personnage_rarete_ssr/edit.html.twig', [
            ' fichePersonnageRareteSsr' =>  $fichePersonnageRareteSsr,
            'form' => $form->createView()
        ]);
        return $this->renderForm('admin_fiche_personnage_rarete_ssr/edit.html.twig', [
            ' fichePersonnageRareteSsr' =>  $fichePersonnageRareteSsr,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_rarete_ssr_delete', methods: ['POST'])]
    public function delete(FichePersonnageRareteSsrRepository $fichePersonnageRareteSsrRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo = $fichePersonnageRareteSsrRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('fichePersonnage_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'La fiche personnage a bien été supprimée');
        return $this->redirectToRoute('admin_fiche_personnage_rarete_ssr_index');
    }
}
