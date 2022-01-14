<?php

namespace App\Controller;

use App\Entity\FrontPageNouveauPersos;
use App\Form\FrontPageNouveauPersosType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FrontPageNouveauPersosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/front/page/nouveau/perso')]
class AdminFrontPageNouveauPersoController extends AbstractController
{
    #[Route('/', name: 'admin_front_page_nouveau_perso_index', methods: ['GET'])]
    public function index(FrontPageNouveauPersosRepository $frontPageNouveauPersosRepository): Response
    {
        return $this->render('admin_front_page_nouveau_perso/index.html.twig', [
            'front_page_nouveau_persos' => $frontPageNouveauPersosRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_front_page_nouveau_perso_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPersos = new FrontPageNouveauPersos();
        $form = $this->createForm(FrontPageNouveauPersosType::class, $frontPageNouveauPersos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg1 = $form['img1']->getData(); // récupère les informations de l'image 1
            $extensionImg1 = $infoImg1->guessExtension(); // récupère l'extension de fichier de l'image 1
            $nomImg1 = time() . '-1.' . $extensionImg1; // reconstitue un nom d'image unique pour l'image 1
            $infoImg1->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg1); // déplace l'image 1 dans le dossier adéquat
            $frontPageNouveauPersos->setImg1($nomImg1); // définit le nom de l'iamge 2 à mettre en base de données
            $infoImg2 = $form['img2']->getData();
            if ($infoImg2 !== null) {
                $extensionImg2 = $infoImg2->guessExtension(); // récupère les informations de l'image 2
                $nomImg2 = time() . '-2.' . $extensionImg2; // reconstitue un nom d'image unique pour l'image 2
                $infoImg2->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg2); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPersos->setImg2($nomImg2); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg3 = $form['img3']->getData();
            if ($infoImg3 !== null) {
                $extensionImg3 = $infoImg3->guessExtension(); // récupère les informations de l'image 2
                $nomImg3 = time() . '-2.' . $extensionImg3; // reconstitue un nom d'image unique pour l'image 2
                $infoImg3->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg3); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPersos->setImg3($nomImg3); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg4 = $form['img4']->getData();
            if ($infoImg4 !== null) {
                $extensionImg4 = $infoImg4->guessExtension(); // récupère les informations de l'image 2
                $nomImg4 = time() . '-2.' . $extensionImg4; // reconstitue un nom d'image unique pour l'image 2
                $infoImg4->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg4); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPersos->setImg4($nomImg4); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg5 = $form['img5']->getData();
            if ($infoImg5 !== null) {
                $extensionImg5 = $infoImg5->guessExtension(); // récupère les informations de l'image 2
                $nomImg5 = time() . '-2.' . $extensionImg5; // reconstitue un nom d'image unique pour l'image 2
                $infoImg5->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg5); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPersos->setImg5($nomImg5); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $infoImg6 = $form['img6']->getData();
            if ($infoImg6 !== null) {
                $extensionImg6 = $infoImg6->guessExtension(); // récupère les informations de l'image 2
                $nomImg6 = time() . '-2.' . $extensionImg6; // reconstitue un nom d'image unique pour l'image 2
                $infoImg6->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg6); // déplace l'image 2 dans le dossier adéquat
                $frontPageNouveauPersos->setImg6($nomImg6); // définit le nom de l'iamge 2 à mettre en base de données
            }
            $manager = $managerRegistry->getManager(); // récupère le manager de Doctrine
            $manager->persist($frontPageNouveauPersos); // dit à Doctrine qu'on va vouloir sauvegarder en bdd
            $manager->flush(); // exécute la requête
            $this->addFlash('success', 'Le perso en front page a bien été ajoutée'); // génère un message flash
            return $this->redirectToRoute('admin_front_page_nouveau_perso_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('admin_front_page_nouveau_perso/new.html.twig', [
            'frontPageNouveauPersos' => $frontPageNouveauPersos,
            'form' => $form, // création de la vue du formulaire et envoi à la vue (fichier)
        ]);
    }

    #[Route('/{id}', name: 'admin_front_page_nouveau_perso_show', methods: ['GET'])]
    public function show(FrontPageNouveauPersos $frontPageNouveauPerso): Response
    {
        return $this->render('admin_front_page_nouveau_perso/show.html.twig', [
            'front_page_nouveau_perso' => $frontPageNouveauPerso,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_front_page_nouveau_perso_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FrontPageNouveauPersosRepository $frontPageNouveauPersosRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPersos =  $frontPageNouveauPersosRepository->find($id);
        $form = $this->createForm(FrontPageNouveauPersosType::class, $frontPageNouveauPersos);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $infoImg1 = $form['img1']->getData();
            $nomOldImg1 = $frontPageNouveauPersos->getImg1(); // récupère le nom de l'ancienne img1
            if ($infoImg1 !== null) { // vérifie si il y a une img1 dans le formulaire
                $cheminOldImg1 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg1;
                if (file_exists($cheminOldImg1)) {
                    unlink($cheminOldImg1); // supprime l'ancienne img1
                }
                $nomImg1 = time() . '-1.' . $infoImg1->guessExtension(); // reconstitue le nom de la nouvelle img1
                $frontPageNouveauPersos->setImg1($nomImg1); // définit le nom de l'img1 de l'objet Maison
                $infoImg1->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg1); // upload
            } else {
                $frontPageNouveauPersos->setImg1($nomOldImg1); // re-définit le nom de l'img1 à mettre en bdd
            }
            $infoImg2 = $form['img2']->getData();
            $nomOldImg2 = $frontPageNouveauPersos->getImg2();
            if ($infoImg2 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg2 !== null) { // on a une img2 en bdd
                    $cheminOldImg2 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg2;
                    if (file_exists($cheminOldImg2)) {
                        unlink($cheminOldImg2);
                    }
                }
                $nomImg2 = time() . '-2.' . $infoImg2->guessExtension();
                $frontPageNouveauPersos->setImg2($nomImg2);
                $infoImg2->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg2);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPersos->setImg2($nomOldImg2);
            }
            $infoImg3 = $form['img3']->getData();
            $nomOldImg3 = $frontPageNouveauPersos->getImg2();
            if ($infoImg3 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg3 !== null) { // on a une img2 en bdd
                    $cheminOldImg3 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg3;
                    if (file_exists($cheminOldImg3)) {
                        unlink($cheminOldImg3);
                    }
                }
                $nomImg3 = time() . '-2.' . $infoImg3->guessExtension();
                $frontPageNouveauPersos->setImg3($nomImg3);
                $infoImg3->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg3);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPersos->setImg3($nomOldImg3);
            }
            $infoImg4 = $form['img4']->getData();
            $nomOldImg4 = $frontPageNouveauPersos->getImg4();
            if ($infoImg4 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg4 !== null) { // on a une img2 en bdd
                    $cheminOldImg4 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg4;
                    if (file_exists($cheminOldImg4)) {
                        unlink($cheminOldImg4);
                    }
                }
                $nomImg4 = time() . '-2.' . $infoImg4->guessExtension();
                $frontPageNouveauPersos->setImg4($nomImg4);
                $infoImg4->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg4);
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPersos->setImg4($nomOldImg4);
            }
            $infoImg5 = $form['img5']->getData();
            $nomOldImg5  = $frontPageNouveauPersos->getImg5 ();
            if ($infoImg5  !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg5  !== null) { // on a une img2 en bdd
                    $cheminOldImg5  = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg4;
                    if (file_exists($cheminOldImg5 )) {
                        unlink($cheminOldImg5 );
                    }
                }
                $nomImg5  = time() . '-2.' . $infoImg5 ->guessExtension();
                $frontPageNouveauPersos->setImg5($nomImg5 );
                $infoImg5 ->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg5 );
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPersos->setImg5($nomOldImg5 );
            }
            $infoImg6 = $form['img6']->getData();
            $nomOldImg6  = $frontPageNouveauPersos->getImg6();
            if ($infoImg6 !== null) { // on a une img2 dans le formulaire
                if ($nomOldImg6 !== null) { // on a une img2 en bdd
                    $cheminOldImg6  = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $nomOldImg6;
                    if (file_exists($cheminOldImg6)) {
                        unlink($cheminOldImg6 );
                    }
                }
                $nomImg6  = time() . '-2.' . $infoImg6 ->guessExtension();
                $frontPageNouveauPersos->setImg6($nomImg6);
                $infoImg6 ->move($this->getParameter('frontPageNouveauPersos_pictures_directory'), $nomImg6 );
            } else { // on a pas d'img2 dans le formulaire
                $frontPageNouveauPersos->setImg6($nomOldImg6 );
            }
            $manager = $managerRegistry->getManager();
            $manager->persist($frontPageNouveauPersos);
            $manager->flush();
            $this->addFlash('success', 'La front page a bien était modifiée');
            return $this->redirectToRoute('admin_front_page_nouveau_perso_index');
        }
        return $this->render('admin_front_page_nouveau_perso/edit.html.twig', [
            'frontPageNouveauPersos' => $frontPageNouveauPersos,
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'admin_front_page_nouveau_perso_delete', methods: ['POST'])]
    public function delete(FrontPageNouveauPersosRepository $frontPageNouveauPersosRepository, int $id, ManagerRegistry $managerRegistry): Response
    {
        $frontPageNouveauPersos = $frontPageNouveauPersosRepository->find($id);
        // throw new \Exception('TODO: gérer la suppression des images du dossier img');
        $img1 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg1();
        $img2 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg2();
        $img3 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg3();
        $img4 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg4();
        $img5 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg5();
        $img6 = $this->getParameter('frontPageNouveauPersos_pictures_directory') . '/' . $frontPageNouveauPersos->getImg6();
        if ($frontPageNouveauPersos->getImg1() && file_exists($img1)) {
            unlink($img1);
        }
        if ($frontPageNouveauPersos->getImg2() && file_exists($img2)) {
            unlink($img2);
        }
        if ($frontPageNouveauPersos->getImg3() && file_exists($img3)) {
            unlink($img4);
        }
        if ($frontPageNouveauPersos->getImg4() && file_exists($img4)) {
            unlink($img4);
        }
        if ($frontPageNouveauPersos->getImg5() && file_exists($img5)) {
            unlink($img5);
        }
        if ($frontPageNouveauPersos->getImg6() && file_exists($img6)) {
            unlink($img6);
        }
        $manager = $managerRegistry->getManager();
        $manager->remove($frontPageNouveauPersos);
        $manager->flush();
        $this->addFlash('success', 'Le perso a bien était supprimée');
        return $this->redirectToRoute('admin_front_page_nouveau_perso_index');
    }
}
