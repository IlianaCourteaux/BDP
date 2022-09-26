<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    // public function contactForm(Request $request, EntityManagerInterface $emi): Response
    // {
    //     $contact = new Contact();

    //     $contactForm = $this->createForm(ContactType::class, $contact);

    //     $contactForm->handleRequest($request);
    
    //     if($contactForm->isSubmitted() && $contactForm->isValid()) {
    //         $contact = $contactForm->getData();
    //         $emi->persist($contact);
    //         $emi->flush();

    //         $this->addFlash(
    //             'success',
    //             'Votre message a bien été envoyé'
    //         );

    //         return $this->redirectToRoute('app_home');
    //     }

    //     return $this->render('home/index.html.twig', [
    //         'contact_form' => $contactForm->createView(),
    //     ]);
    // }
}
