<?php

namespace App\Controller;

use App\Entity\FrontPageNouveauPerso;
use App\Form\FrontPageNouveauPersoType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FrontPageNouveauPersoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/front/page/nouveau/perso')]
class AdminFrontPageNouveauPersoController extends AbstractController
{
    #[Route('/', name: 'admin_front_page_nouveau_perso_index', methods: ['GET'])]
    public function index(FrontPageNouveauPersoRepository $frontPageNouveauPersoRepository): Response
    {
        return $this->render('admin_front_page_nouveau_perso/index.html.twig', [
            'front_page_nouveau_persos' => $frontPageNouveauPersoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_front_page_nouveau_perso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPerso = new FrontPageNouveauPerso();
        $form = $this->createForm(FrontPageNouveauPersoType::class, $frontPageNouveauPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'image 1
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'image 1
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'image unique pour l'image 1
            $infoImg->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg); // déplace l'image 1 dans le dossier adéquat
            $frontPageNouveauPerso->setImg($nomImg); // définit le nom de l'iamge 2 à mettre en base de données
    
            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($frontPageNouveauPerso); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'Le perso en front page a bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_front_page_nouveau_perso_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_front_page_nouveau_perso/new.html.twig', [
            'front_page_nouveau_perso' => $frontPageNouveauPerso,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_front_page_nouveau_perso_show', methods: ['GET'])]
    public function show(FrontPageNouveauPerso $frontPageNouveauPerso): Response
    {
        return $this->render('admin_front_page_nouveau_perso/show.html.twig', [
            'front_page_nouveau_perso' => $frontPageNouveauPerso,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_front_page_nouveau_perso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FrontPageNouveauPersoRepository $frontPageNouveauPersoRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPerso =  $frontPageNouveauPersoRepository->find($id);
        $form = $this->createForm(FrontPageNouveauPersoType::class, $frontPageNouveauPerso);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $frontPageNouveauPerso->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $frontPageNouveauPerso->setImg($nomImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg); // upload
            } else {
                $frontPageNouveauPerso->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($frontPageNouveauPerso);
            $manager->flush();
            $this->addFlash('success', 'La front page a bien était modifiée');
            return $this->redirectToRoute('admin_front_page_nouveau_perso_index');
        }
        return $this->render('admin_front_page_nouveau_perso/edit.html.twig', [
            'front_page_nouveau_perso' => $frontPageNouveauPerso,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_front_page_nouveau_perso_delete', methods: ['POST'])]
    public function delete(FrontPageNouveauPersoRepository $frontPageNouveauPersoRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPerso = $frontPageNouveauPersoRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg();
        if ($frontPageNouveauPerso->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($frontPageNouveauPerso);
        $manager->flush();
        $this->addFlash('success', 'Le perso a bien était supprimée');
        return $this->redirectToRoute('admin_front_page_nouveau_perso_index');
    }
}