<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

#[Route('/contact')]
class ContactController extends AbstractController
{
    
    #[Route('/', name: 'contact', methods: ['GET'])]
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['email'])
                ->to('dokkanbattlefrancecontact@gmail.com')
                ->subject('vous avez reçu un email')
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                    $contactFormData['Message'],
                    'text/plain');
            $mailer->send($message);

            $this->addFlash('success', 'Vore message a été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}