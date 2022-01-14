<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\EncyclopedieDesPersonnages;
use App\Form\EncyclopedieDesPersonnagesType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use App\Repository\EncyclopedieDesPersonnagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/encyclopedie/des/personnages')]
class AdminEncyclopedieDesPersonnagesController extends AbstractController
{
    #[Route('/', name: 'admin_encyclopedie_des_personnages_index', methods: ['GET'])]
    public function index(EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository): Response
    {
        return $this->render('admin_encyclopedie_des_personnages/index.html.twig', [
            'encyclopedie_des_personnages' => $encyclopedieDesPersonnagesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_encyclopedie_des_personnages_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $encyclopedieDesPersonnages = new EncyclopedieDesPersonnages();
        $form = $this->createForm(EncyclopedieDesPersonnagesType::class, $encyclopedieDesPersonnages);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('encyclopedieDesPersonnages_pictures_directory'), $nomImg); // déplace l'Img 1 dans le dossier adéquat
            $encyclopedieDesPersonnages->setImg($nomImg); // définit le nom de l'image à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($encyclopedieDesPersonnages); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'La encyclopedieDesPersonnages a bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_encyclopedie_des_personnages_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_encyclopedie_des_personnages/new.html.twig', [
            'encyclopedieDesPersonnage' => $encyclopedieDesPersonnages,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/admin/encyclopedie/des/personnages-{id}', name: 'admin_encyclopedie_des_personnages_show', methods: ['GET'])]
    public function show(EncyclopedieDesPersonnages $encyclopedieDesPersonnages, EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id): Response
    {
        $personnages = $encyclopedieDuPersonnageRepository->findBy(['encyclopedieDesPersonnages' => $id]);
        return $this->render('admin_encyclopedie_des_personnages/show.html.twig', [
            'personnages' => $personnages,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_encyclopedie_des_personnages_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $encyclopedieDesPersonnages = $encyclopedieDesPersonnagesRepository->find($id);
        $form = $this->createForm(EncyclopedieDesPersonnagesType::class, $encyclopedieDesPersonnages);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $encyclopedieDesPersonnages->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('encyclopedieDesPersonnages_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $encyclopedieDesPersonnages->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('encyclopedieDesPersonnages_pictures_directory'), $nomOldImg); // upload
            } else {
                $encyclopedieDesPersonnages->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($encyclopedieDesPersonnages);
            $manager->flush();
            $this->addFlash('success', 'L\'encyclopédie des personnages bien été modifiée');
            return $this->redirectToRoute('admin_encyclopedie_des_personnages_index');
        }
        return $this->render('admin_encyclopedie_des_personnages/edit.html.twig', [
            'encyclopedieDesPersonnages' => $encyclopedieDesPersonnages,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_encyclopedie_des_personnages_delete', methods: ['POST'])]
    public function delete(EncyclopedieDesPersonnagesRepository $encyclopedieDesPersonnagesRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo = $encyclopedieDesPersonnagesRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('encyclopedieDesPersonnages_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'L\'encyclopédie a bien été supprimée');
        return $this->redirectToRoute('admin_encyclopedie_des_personnages_index');
    }
}
