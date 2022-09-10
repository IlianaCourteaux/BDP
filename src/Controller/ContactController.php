<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, EntityManagerInterface $emi, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        if($this->getUser()) {
            $contact
                ->setUsername($this->getUser()->getUsername())
                ->setEmail($this->getUser()->getEmail());
        }

        $form=$this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $emi->persist($contact);
            $emi->flush();

            $email = (new TemplatedEmail())
            ->from($contact->getEmail())
            ->to('contact@batonnets.fr')
            ->subject('Sujet')
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact,
            ]);

        $mailer->send($email);

            $this->addFlash(
                'success',
                'Votre message a bien été envoyé'
            );

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
            // 'contact_form' => $form
        ]);
    }
}
