<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){ // soumet une adresse mail

            $data = $form->getData(); //recupere l'adresse mail

            $email = (new Email())
            ->from($data['email']) //adresse mail de l'utilisateur
            ->to('dokkanbattlefrancecontact@gmail.com') // adresse mail (la mienne) pour me contacter
            ->subject($data['sujet']) //sujet sur le quelle un utilisateur veux me contacter
            ->html($data['message']);// le messag que m'envois l'utilisateur

        $mailer->send($email); //envois de l'email

        return $this->redirectToRoute('home');// email envoyer donc retour en page d'accueil

        }

        return $this->renderForm('contact/index.html.twig', [
            'formulaire' => $form
        ]);
    }
}
