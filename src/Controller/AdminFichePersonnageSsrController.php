<?php

namespace App\Controller;

use App\Entity\FichePersonnageSsr;
use App\Form\FichePersonnageSsrType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FichePersonnageSsrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/fiche/personnage/ssr')]
class AdminFichePersonnageSsrController extends AbstractController
{
    #[Route('/', name: 'admin_fiche_personnage_ssr_index', methods: ['GET'])]
    public function index(FichePersonnageSsrRepository $fichePersonnageSsrRepository): Response
    {
        return $this->render('admin_fiche_personnage_ssr/index.html.twig', [
            'fiche_personnage_ssrs' => $fichePersonnageSsrRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_fiche_personnage_ssr_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageSsr = new FichePersonnageSsr();
        $form = $this->createForm(FichePersonnageSsrType::class, $fichePersonnageSsr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('fichePersonnageSsr_pictures_directory'), $nomImg); // déplace l'Img 1 dans le dossier adéquat
            $fichePersonnageSsr ->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($fichePersonnageSsr ); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La Fiche Personnage bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_fiche_personnage_ssr_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_fiche_personnage_ssr/new.html.twig', [
            'fiche_personnage_ssr ' => $fichePersonnageSsr ,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ssr_show', methods: ['GET'])]
    public function show(FichePersonnageSsr $fichePersonnageSsr): Response
    {
        return $this->render('admin_fiche_personnage_ssr/show.html.twig', [
            'fiche_personnage_ssr' => $fichePersonnageSsr,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_fiche_personnage_ssr_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FichePersonnageSsrRepository $fichePersonnageSsrRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $fichePersonnageSsr = $fichePersonnageSsrRepository->find($id);
        $form = $this->createForm(FichePersonnageSsrType::class, $fichePersonnageSsr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $fichePersonnageSsr->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('fichePersonnageSsr_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $fichePersonnageSsr->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('fichePersonnageSsr_pictures_directory'), $nomOldImg); // upload
            } else {
                $fichePersonnageSsr->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($fichePersonnageSsr);
            $manager->flush();
            $this->addFlash('success', 'La Fiche Personnage a bien été modifiée');
            return $this->redirectToRoute('admin_fiche_personnage_ssr_index');
        }
        return $this->render('admin_fiche_personnage_ssr/edit.html.twig', [
            'fiche_personnage_ssr' => $fichePersonnageSsr,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_fiche_personnage_ssr_delete', methods: ['POST'])]
    public function delete(FichePersonnageSsrRepository $fichePersonnageSsrRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo =  $fichePersonnageSsrRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('fichePersonnageSsr_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'La Fiche Personnage a bien été supprimée');
        return $this->redirectToRoute('admin_fiche_personnage_ssr_index');
    }
}
