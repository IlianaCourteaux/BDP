<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class ArticleService
{
    public function __construct(
        private RequestStack $requestStack,
        private ArticleRepository $articleRep,
        private PaginatorInterface $paginator) 
    {

    }

    public function getPaginatedArticles(?Category $category = null) : PaginationInterface
    {
        $request = $this->requestStack->getMainRequest();
        $page = $request->query->getInt('page', 1);
        $limit = 6;

        $articlesQuery = $this->articleRep->findForPagination($category);

        return $this->paginator->paginate($articlesQuery, $page, $limit);
    }
}