<?php

namespace App\Controller;

use App\Entity\EncyclopedieDuPersonnage;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EncyclopedieDuPersonnageType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EncyclopedieDuPersonnageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/encyclopedie/du/personnage')]
class AdminEncyclopedieDuPersonnageController extends AbstractController
{
    #[Route('/', name: 'admin_encyclopedie_du_personnage_index', methods: ['GET'])]
    public function index(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository): Response
    {
        return $this->render('admin_encyclopedie_du_personnage/index.html.twig', [
            'encyclopedie_du_personnages' => $encyclopedieDuPersonnageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_encyclopedie_du_personnage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $encyclopedieDuPersonnage = new EncyclopedieDuPersonnage();
        $form = $this->createForm(EncyclopedieDuPersonnageType::class, $encyclopedieDuPersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData(); // récupère les informations de l'Img 
            $extensionImg = $infoImg->guessExtension(); // récupère l'extension de fichier de l'Img 
            $nomImg = time() . '-1.' . $extensionImg; // reconstitue un nom d'Img unique pour l'Img 
            $infoImg->move($this->getParameter('encyclopedieDuPersonnage_pictures_directory'), $nomImg); // déplace l'Img dans le dossier adéquat
            $encyclopedieDuPersonnage->setImg($nomImg); // définit le nom de l'iamge 2 à mettre en base de données

            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($encyclopedieDuPersonnage); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'L\'encyclopédie du personnage a bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_encyclopedie_du_personnage_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_encyclopedie_du_personnage/new.html.twig', [
            'encyclopedieDuPersonnage' => $encyclopedieDuPersonnage,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_encyclopedie_du_personnage_show', methods: ['GET'])]
    public function show(EncyclopedieDuPersonnage $encyclopedieDuPersonnage): Response
    {
        return $this->render('admin_encyclopedie_du_personnage/show.html.twig', [
            'encyclopedie_du_personnage' => $encyclopedieDuPersonnage,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_encyclopedie_du_personnage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $encyclopedieDuPersonnage = $encyclopedieDuPersonnageRepository->find($id);
        $form = $this->createForm(EncyclopedieDuPersonnageType::class, $encyclopedieDuPersonnage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg = $form['img']->getData();
            $nomOldImg = $encyclopedieDuPersonnage->getImg(); // récupère le nom de l'ancienne img1
            if ($infoImg !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg = $this->getParameter('encyclopedieDuPersonnage_pictures_directory') . '/' .$nomOldImg;
                if (file_exists($cheminOldImg)) {
                    unlink($cheminOldImg); // supprime l'ancienne img1
                }
                $nomOldImg = time() . '-1.' . $infoImg->guessExtension(); // reconstitue le nom de la nouvelle img1
                $encyclopedieDuPersonnage->setImg($nomOldImg); // définit le nom de l'img1 de l'objet Maison
                $infoImg->move($this->getParameter('encyclopedieDuPersonnage_pictures_directory'), $nomOldImg); // upload
            } else {
                $encyclopedieDuPersonnage->setImg($nomOldImg); // re-définit le nom de l'img1 à mettre en bdd
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($encyclopedieDuPersonnage);
            $manager->flush();
            $this->addFlash('success', 'L\'encyclopédie des personnages bien été modifiée');
            return $this->redirectToRoute('admin_encyclopedie_du_personnage_index');
        }
        return $this->render('admin_encyclopedie_du_personnage/edit.html.twig', [
            'encyclopedie_du_personnage' => $encyclopedieDuPersonnage,
            'form' => $form->createView()
        ]);
        return $this->renderForm('admin_encyclopedie_du_personnage/edit.html.twig', [
            'encyclopedie_du_personnage' => $encyclopedieDuPersonnage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_encyclopedie_du_personnage_delete', methods: ['POST'])]
    public function delete(EncyclopedieDuPersonnageRepository $encyclopedieDuPersonnageRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $logo = $encyclopedieDuPersonnageRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img = $this->getParameter('encyclopedieDuPersonnage_pictures_directory') . '/' . $logo->getImg();
        if ($logo->getImg() && file_exists($img)) {
            unlink($img);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($logo);
        $manager->flush();
        $this->addFlash('success', 'L\'encyclopédie du personnage a bien été supprimée');
        return $this->redirectToRoute('admin_encyclopedie_du_personnage_index');
    }
}
