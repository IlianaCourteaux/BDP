<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('article/index.html.twig', [
            'articlesList' => $manager->getRepository(Article::class)->findAll()
        ]);
    }

    // #[Route('articles/{slug}-{id}', name: 'app_single', methods: ['GET', 'POST'], requirements: ['slug' => '[a-z0-9\-]', 'id' => '\d+'])]
    // public function single($slug, int $id, ManagerRegistry $manager):Response
    // {
    //     $article = $manager->getRepository(Properties::class)->find($id);
    //     return $this->renderForm('articles/single.html.twig',[
    //         'current_menu' => 'articles',
    //         'article' => $article
    //     ]);
    // }

    #[Route('articles/{id}', name: 'app_single', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function single(int $id, ManagerRegistry $manager):Response
    {
        $article = $manager->getRepository(Article::class)->find($id);
        return $this->renderForm('article/single.html.twig',[
            'current_menu' => 'articles',
            'article' => $article,
        ]);
    }
}
