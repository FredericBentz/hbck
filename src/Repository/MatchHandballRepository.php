<?php

namespace App\Repository;

use App\Entity\MatchHandball;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MatchHandball|null find($id, $lockMode = null, $lockVersion = null)
 * @method MatchHandball|null findOneBy(array $criteria, array $orderBy = null)
 * @method MatchHandball[]    findAll()
 * @method MatchHandball[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MatchHandballRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatchHandball::class);
    }

    // /**
    //  * @return MatchHandball[] Returns an array of MatchHandball objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MatchHandball
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
