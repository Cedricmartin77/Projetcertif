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
            $infoImg2 = $form['img2']->getData();
            if ($infoImg2 !== null) {
                $extensionImg2 = $infoImg2->guessExtension(); // récupère les informations de l'image 2
                $nomImg2 = time() . '-2.' . $extensionImg2; // reconstitue un nom d'image unique pour l'image 2
                $infoImg2->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg2); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPerso->setImg2($nomImg2); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg3 = $form['img3']->getData();
            if ($infoImg3 !== null) {
                $extensionImg3 = $infoImg3->guessExtension(); // récupère les informations de l'image 2
                $nomImg3 = time() . '-3.' . $extensionImg3; // reconstitue un nom d'image unique pour l'image 2
                $infoImg3->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg3); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPerso->setImg3($nomImg3); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg4 = $form['img4']->getData();
            if ($infoImg4 !== null) {
                $extensionImg4 = $infoImg4->guessExtension(); // récupère les informations de l'image 2
                $nomImg4 = time() . '-4.' . $extensionImg4; // reconstitue un nom d'image unique pour l'image 2
                $infoImg4->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg4); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPerso->setImg4($nomImg4); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg5 = $form['img5']->getData();
            if ($infoImg5 !== null) {
                $extensionImg5 = $infoImg5->guessExtension(); // récupère les informations de l'image 2
                $nomImg5 = time() . '-5.' . $extensionImg5; // reconstitue un nom d'image unique pour l'image 2
                $infoImg5->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg5); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPerso->setImg5($nomImg5); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg6 = $form['img6']->getData();
            if ($infoImg6 !== null) {
                $extensionImg6 = $infoImg6->guessExtension(); // récupère les informations de l'image 2
                $nomImg6 = time() . '-6.' . $extensionImg6; // reconstitue un nom d'image unique pour l'image 2
                $infoImg6->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg6); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPerso->setImg6($nomImg6); // définit le nom de l'iamge 2 à mettre en base de données
            }
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
            $infoImg2 = $form['img2']->getData();
            $nomOldImg2 = $frontPageNouveauPerso->getImg2();
            if ($infoImg2 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg2 !== null) { // on a une img2 en bdd
                    $cheminOldImg2 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg2;
                    if (file_exists($cheminOldImg2)) {
                        unlink($cheminOldImg2);
                    }
                }
                $nomImg2 = time() . '-2.' . $infoImg2->guessExtension();
                $frontPageNouveauPerso->setImg2($nomImg2);
                $infoImg2->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg2);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPerso->setImg2($nomOldImg2);
            }
            $infoImg3 = $form['img3']->getData();
            $nomOldImg3 = $frontPageNouveauPerso->getImg3();
            if ($infoImg3 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg3 !== null) { // on a une img2 en bdd
                    $cheminOldImg3 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg3;
                    if (file_exists($cheminOldImg3)) {
                        unlink($cheminOldImg3);
                    }
                }
                $nomImg3 = time() . '-3.' . $infoImg3->guessExtension();
                $frontPageNouveauPerso->setImg3($nomImg3);
                $infoImg3->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg3);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPerso->setImg3($nomOldImg3);
            }
            $infoImg4 = $form['img4']->getData();
            $nomOldImg4 = $frontPageNouveauPerso->getImg4();
            if ($infoImg4 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg4 !== null) { // on a une img2 en bdd
                    $cheminOldImg4 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg4;
                    if (file_exists($cheminOldImg4)) {
                        unlink($cheminOldImg4);
                    }
                }
                $nomImg4 = time() . '-4.' . $infoImg4->guessExtension();
                $frontPageNouveauPerso->setImg4($nomImg4);
                $infoImg4->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg4);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPerso->setImg4($nomOldImg4);
            }
            $infoImg5 = $form['img5']->getData();
            $nomOldImg5  = $frontPageNouveauPerso->getImg5 ();
            if ($infoImg5  !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg5  !== null) { // on a une img2 en bdd
                    $cheminOldImg5  = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg5;
                    if (file_exists($cheminOldImg5 )) {
                        unlink($cheminOldImg5 );
                    }
                }
                $nomImg5  = time() . '-5.' . $infoImg5 ->guessExtension();
                $frontPageNouveauPerso->setImg5($nomImg5 );
                $infoImg5 ->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg5 );
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPerso->setImg5($nomOldImg5 );
            }
            $infoImg6 = $form['img6']->getData();
            $nomOldImg6  = $frontPageNouveauPerso->getImg6();
            if ($infoImg6 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg6 !== null) { // on a une img2 en bdd
                    $cheminOldImg6  = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $nomOldImg6;
                    if (file_exists($cheminOldImg6)) {
                        unlink($cheminOldImg6 );
                    }
                }
                $nomImg6  = time() . '-6.' . $infoImg6 ->guessExtension();
                $frontPageNouveauPerso->setImg6($nomImg6);
                $infoImg6 ->move($this->getParameter('frontPageNouveauPersonnage_pictures_directory'), $nomImg6 );
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPerso->setImg6($nomOldImg6 );
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
        $img2 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg2();
        $img3 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg3();
        $img4 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg4();
        $img5 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg5();
        $img6 = $this->getParameter('frontPageNouveauPersonnage_pictures_directory') . '/' . $frontPageNouveauPerso->getImg6();
        if ($frontPageNouveauPerso->getImg() && file_exists($img)) {
            unlink($img);
        }
        if ($frontPageNouveauPerso->getImg2() && file_exists($img2)) {
            unlink($img2);
        }
        if ($frontPageNouveauPerso->getImg3() && file_exists($img3)) {
            unlink($img3);
        }
        if ($frontPageNouveauPerso->getImg4() && file_exists($img4)) {
            unlink($img4);
        }
        if ($frontPageNouveauPerso->getImg5() && file_exists($img5)) {
            unlink($img5);
        }
        if ($frontPageNouveauPerso->getImg6() && file_exists($img6)) {
            unlink($img6);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($frontPageNouveauPerso);
        $manager->flush();
        $this->addFlash('success', 'Le perso a bien était supprimée');
        return $this->redirectToRoute('admin_front_page_nouveau_perso_index');
    }
}
