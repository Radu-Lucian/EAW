<?php

namespace App\Repository;

use App\Entity\Talons;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Talons|null find($id, $lockMode = null, $lockVersion = null)
 * @method Talons|null findOneBy(array $criteria, array $orderBy = null)
 * @method Talons[]    findAll()
 * @method Talons[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TalonsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Talons::class);
    }

    public function findByUserId($value)
    {
        return $this->createQueryBuilder('a')
            ->join('a.FK_talon_car_id', 'b')
            ->join('b.FK_car_user_id', 'c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return Talons[] Returns an array of Talons objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Talons
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
