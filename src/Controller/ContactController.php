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
        if ($form->isSubmitted() && $form->isValid()){

            $data = $form->getData();

            $email = (new Email())
            ->from($data['email'])
            ->to('dokkanbattlefrancecontact@gmail.com')
            ->subject($data['sujet'])
            ->html($data['message']);

        $mailer->send($email);

        return $this->redirectToRoute('home');

        }

        return $this->renderForm('contact/index.html.twig', [
            'formulaire' => $form
        ]);
    }
}
