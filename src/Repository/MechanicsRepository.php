<?php

namespace App\Repository;

use App\Entity\Mechanics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mechanics|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mechanics|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mechanics[]    findAll()
 * @method Mechanics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MechanicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mechanics::class);
    }

    // /**
    //  * @return Mechanics[] Returns an array of Mechanics objects
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
    public function findOneBySomeField($value): ?Mechanics
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
