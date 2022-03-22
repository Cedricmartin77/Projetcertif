<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[Route('/admin/user')]
class AdminUserController extends AbstractController
{
    #[Route('/', name: 'admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin_user/index.html.twig', [ //index gerer les utilisateur
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);//genere le fomulaire
        $form->handleRequest($request); // sers a traitée une requete

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData() // crée un nouvel utilisateur avec mot de passe et email avec mot de passe hashé
                    )
                );
            $entityManager->persist($user);// utilise doctrine pour envoyer en base de donnée
            $entityManager->flush(); // envoi en base de données

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER); //retour a l'index gerer les utilisateur
        }

        return $this->renderForm('admin_user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin_user/show.html.twig', [ // sers a "voir" l'utilisateur
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UserPasswordHasherInterface $userPasswordHasher, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request); // sers a traité une requete

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('password')->getData()//sers a modifier un utilisateur en ayant sont mot de passe hashé
                    )
                );
            $entityManager->flush();//utiliser doctrine pour envoyer les modification en base de données

            return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER); //retour a l'index gerer les utilisateur
        }

        return $this->renderForm('admin_user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {//reçois et valide la demande de suppression
            $entityManager->remove($user);//sers a suprimer un utilisateur de la base de données
            $entityManager->flush();//sers a envoyer les modification fait en utilisant doctrine en base de données
        }

        return $this->redirectToRoute('admin_user_index', [], Response::HTTP_SEE_OTHER);//redirection a l'index admin_user
    }
}
