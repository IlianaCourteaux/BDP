<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Repository\ArticleRepository;
use App\Repository\CommentsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Routing\Annotation\Route;

class CommentsController extends AbstractController
{
    #[Route('/ajax/comments', name: 'app_comments')]
    public function add(Request $request, ArticleRepository $articleRep, UsersRepository $userRep, CommentsRepository $commentRep, EntityManagerInterface $emi): Response
    {
        $commentData = $request->request->all('comment');

        if (!$this->isCsrfTokenValid('comment-add', $commentData['_token'])) {
            return $this->json([
                'code' => 'INVALID_CSRF_TOKEN'
            ],
            Response::HTTP_BAD_REQUEST);
        }

        $article = $articleRep->findOneBy(['id' => $commentData['article']]);

        if(!$article) {
            return $this->json([
                'code' => 'ARTICLE_NOT_FOUND'
            ],
            Response::HTTP_BAD_REQUEST);
        }

        $comment = new Comments($article);
        $comment->setText($commentData['content']);
        $comment->setCreatedAt(new \DateTimeImmutable());
        $comment->setUser($userRep->findOneBy(['id'=> 1]));

        $emi->persist($comment);
        $emi->flush();

        $html = $this->renderView('comments/index.html.twig', [
            'comment' => $comment
        ]);

        return $this->json([
            'code' => 'COMMENT_ADDED_SUCCESSFULLY',
            'message' => $html,
            'numberOfCOmments' => $commentRep->count(['article' => $article])
        ]);
    }
}
