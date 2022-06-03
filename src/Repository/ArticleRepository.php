<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
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

    public function findAllActiveNewestFirst()
    {
        $now = new \DateTime();

        return $this->createQueryBuilder('a')
            ->andWhere('a.enabled = :enabled')
            ->andWhere('a.publishedDate <= :date')
            ->setParameter('enabled', true)
            ->setParameter('date', $now->format('Y-m-d H:i:s'))
            ->orderBy('a.publishedDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    public function findAllActiveFeatured()
    {
        $now = new \DateTime();
        $oneWeekAgo = new \DateTime();
        $weekInterval = new \DateInterval('P1W');
        $oneWeekAgo->sub($weekInterval);

        $articles = $this->createQueryBuilder('a')
            ->andWhere('a.enabled = :enabled')
            ->andWhere('a.publishedDate <= :date')
            ->andWhere('a.featuredPriority > 0
                OR a.publishedDate >= :weekAgoDate')
            ->setParameter('enabled', true)
            ->setParameter('date', $now->format('Y-m-d H:i:s'))
            ->setParameter('weekAgoDate', $oneWeekAgo->format('Y-m-d H:i:s'))
            ->getQuery()
            ->getResult();

        usort($articles,
            function(Article $article1, Article $article2) {
                if ($article1->isRecent()) {
                    if ($article2->isRecent()) {
                        return $article1->getFeaturedPriority() < $article2->getFeaturedPriority();
                    } else {
                        return -1;
                    }
                }

                if ($article2->isRecent()) {
                    return 1;
                }

                return $article1->getFeaturedPriority() < $article2->getFeaturedPriority();
            }
        );

        return $articles;
    }
}
