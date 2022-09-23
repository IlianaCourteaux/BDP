<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\CommentsRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class CommentsService
{
    public function __construct(
        private RequestStack $requestStack,
        private CommentsRepository $commentsRep,
        private PaginatorInterface $paginator) 
    {

    }

    public function getPaginatedComments(?Article $article = null) : PaginationInterface
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 8;

        $commentsQuery = $this->commentsRep->findForPagination($article);

        return $this->paginator->paginate($commentsQuery, $page, $limit);
    }
}