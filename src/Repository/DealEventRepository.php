<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\DealEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DealEvent|null find($id, $lockMode = null, $lockVersion = null)
 * @method DealEvent|null findOneBy(array $criteria, array $orderBy = null)
 * @method DealEvent[]    findAll()
 * @method DealEvent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DealEventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DealEvent::class);
    }

    // /**
    //  * @return DealEvent[] Returns an array of DealEvent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DealEvent
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
