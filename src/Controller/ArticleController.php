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
use App\Service\ArticleService;
use App\Service\CommentsService;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class ArticleController extends AbstractController
{

    #[Route('/articles', name: 'app_articles')]
    public function index(ManagerRegistry $manager, ArticleService $articleService): Response
    {
        return $this->render('article/index.html.twig', [
            // 'articlesList' => $manager->getRepository(Article::class)->findAll()
            'articlesList' => $articleService->getPaginatedArticles(),
        ]);
    }
    
    #[Route('article/{slug}', name: 'app_single', methods: ['GET', 'POST'])]
    public function single(?Article $article, EntityManagerInterface $emi, CommentsService $commentsService):Response
    {
        if(!$article) {
            return $this->redirectToRoute('app_home');
        }

        // Formulaire de commentaires
        $comment = new Comments($article);

        $commentForm = $this->createForm(CommentsType::class, $comment);
        
        if($commentForm->isSubmitted() && $commentForm->isValid()) {
            $comment->setCreatedAt(new DateTime());
            $comment->setArticle($article);

            $parentid = $commentForm->get("parent")->getData();

            $emi = $this->getDoctrine()->getManager();

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
            'comments' =>$commentsService->getPaginatedComments($article)
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
