<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Comments;
use App\Form\CommentsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ArticleService;
use App\Service\CommentsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends AbstractController
{

    #[Route('/articles', name: 'app_articles')]
    public function index(ArticleService $articleService): Response
    {
        return $this->render('article/index.html.twig', [
            'articlesList' => $articleService->getPaginatedArticles(),
        ]);
    }
    
    #[Route('article/{slug}', name: 'app_single', methods: ['GET', 'POST'])]
    public function single(?Article $article, EntityManagerInterface $emi, CommentsService $commentsService, Request $request):Response
    {
        if(!$article) {
            return $this->redirectToRoute('app_home');
        }

        $article->setText(html_entity_decode($article->getText()));

        // Formulaire de commentaires
        $comment = new Comments($article);

        $commentForm = $this->createForm(CommentsType::class, $comment);
        $commentForm->handleRequest($request);
        
        if($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setCreatedAt(new \DateTime());
            $comment->setArticle($article);

            $parentid = $commentForm->get("parent")->getData();

            if($parentid != null) {
            $parent = $emi->getRepository(Comments::class)->find($parentid);
            }

            $comment->setParent($parent ?? null);

            $emi->persist($comment);
            $emi->flush();

            $this->addFlash(
                'success',
                'Votre commentaire a bien été envoyé'
            );

            return $this->redirectToRoute('app_single', ['slug' => $article->getSlug()]); 
        }    

        return $this->renderForm('article/single.html.twig',[
            'article' => $article,
            'commentForm' => $commentForm,
            'comments' => $commentsService->getPaginatedComments($article)
        ]);
    }
}
