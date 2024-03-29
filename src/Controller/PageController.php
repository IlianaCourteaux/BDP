<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/page/{slug}', name: 'app_page', methods: ['GET', 'POST'])]
    public function index(?Page $page): Response
    {
        if(!$page) {
            return $this->redirectToRoute('app_home');
        }

        return $this->render('page/single.html.twig', [
            'page' => $page,
        ]);
    }
    
}
