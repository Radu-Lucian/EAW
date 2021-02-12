<?php

namespace App\Repository;

use App\Entity\UserTickets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserTickets|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTickets|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTickets[]    findAll()
 * @method UserTickets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTicketsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTickets::class);
    }

    public function findByUserId($value)
    {
        return $this->createQueryBuilder('a')
            ->join('a.FK_user_ticket_car_id', 'b')
            ->join('b.FK_car_user_id', 'c')
            ->andWhere('c.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return UserTickets[] Returns an array of UserTickets objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserTickets
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
