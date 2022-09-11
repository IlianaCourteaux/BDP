<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comments;
use App\Form\CommentsType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ManagerRegistry $manager): Response
    {
        return $this->render('article/index.html.twig', [
            'articlesList' => $manager->getRepository(Article::class)->findAll()
        ]);
    }

    #[Route('articles/{slug}', name: 'app_single', methods: ['GET', 'POST'])]
    public function single(?Article $article, EntityManagerInterface $emi):Response
    {
        if(!$article) {
            return $this->redirectToRoute('app_home');
        }

        $comment = new Comments($article);

        $commentForm = $this->createForm(CommentsType::class);
        
        // if($commentForm->isSubmitted() && $commentForm->isValid()) {
        //     $comments = $commentForm->getData();

        //     $this->addFlash(
        //         'success',
        //         'Votre commentaire a bien été envoyé'
        //     );

        //     $emi->persist($comments);
        //     $emi->flush();

        //     return $this->redirectToRoute('app_single'); 
        // }

                

        return $this->renderForm('article/single.html.twig',[
            'article' => $article,
            'commentForm' => $commentForm
        ]);
    }

    // #[Route('articles/{id}', name: 'app_single', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    // public function single(int $id, ManagerRegistry $manager):Response
    // {
    //     $article = $manager->getRepository(Article::class)->find($id);
    //     return $this->renderForm('article/single.html.twig',[
    //         'current_menu' => 'articles',
    //         'article' => $article,
    //     ]);
    // }
}
