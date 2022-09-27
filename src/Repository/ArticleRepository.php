<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findForPagination(?Category $category = null): Query
    {
        $qb = $this->createQueryBuilder('art')
            ->where('art.Published = true')
            ->orderBy('art.createdAt', 'DESC');

        if ($category)
        {
            $qb
                ->leftJoin('art.categories', 'cat')
                ->where($qb->expr()->eq('cat.id', ':categoryId'))
                ->setParameter('categoryId', $category->getId());
        }

        return $qb->getQuery();
    }

    public function findWithSearchword ($searchword): ?array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->where($qb->expr()->like('p.title', $qb->expr()->literal('%'. $searchword . '%')))
            ->join('p.subCategories', 's')
            ->orWhere($qb->expr()->like('p.text', $qb->expr()->literal('%'. $searchword . '%')))
            ->orWhere($qb->expr()->like('s.name', $qb->expr()->literal('%'. $searchword .'%')))
        ;
        return $qb->getQuery()->getResult();
    }

    // public function add(Article $entity, bool $flush = false): void
    // {
    //     $this->getEntityManager()->persist($entity);

    //     if ($flush) {
    //         $this->getEntityManager()->flush();
    //     }
    // }

    // public function remove(Article $entity, bool $flush = false): void
    // {
    //     $this->getEntityManager()->remove($entity);

    //     if ($flush) {
    //         $this->getEntityManager()->flush();
    //     }
    // }

//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
