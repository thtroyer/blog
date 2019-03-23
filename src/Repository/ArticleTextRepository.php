<?php

namespace App\Repository;

use App\Entity\ArticleText;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ArticleText|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleText|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleText[]    findAll()
 * @method ArticleText[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleTextRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ArticleText::class);
    }

    // /**
    //  * @return ArticleText[] Returns an array of ArticleText objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ArticleText
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
