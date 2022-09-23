<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    // public function contactform(Request $request, EntityManagerInterface $emi, MailerInterface $mailer): Response
    // {
    //     $contact = new Contact();

    //     if($this->getUser()) {
    //         $contact
    //             ->setUsername($this->getUser()->getUsername())
    //             ->setEmail($this->getUser()->getEmail());
    //     }

    //     $form=$this->createForm(ContactType::class, $contact);

    //     $form->handleRequest($request);
        
    //     if($form->isSubmitted() && $form->isValid()) {
    //         $contact = $form->getData();
    //         $emi->persist($contact);
    //         $emi->flush();

    //         $email = (new TemplatedEmail())
    //         ->from($contact->getEmail())
    //         ->to('contact@batonnets.fr')
    //         ->subject('Sujet')
    //         ->htmlTemplate('emails/contact.html.twig')
    //         ->context([
    //             'contact' => $contact,
    //         ]);

    //         $mailer->send($email);

    //         $this->addFlash(
    //             'success',
    //             'Votre message a bien été envoyé'
    //         );

    //         return $this->redirectToRoute('app_home');
    //     }

    //     return $this->render('home/index.html.twig', [
    //         'contact_form' => $form->createView(),
    //     ]);
    // }
}
