<?php

namespace App\Repository;

use App\Entity\UserTicketsMechanics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserTicketsMechanics|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserTicketsMechanics|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserTicketsMechanics[]    findAll()
 * @method UserTicketsMechanics[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserTicketsMechanicsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserTicketsMechanics::class);
    }

    // /**
    //  * @return UserTicketsMechanics[] Returns an array of UserTicketsMechanics objects
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
    public function findOneBySomeField($value): ?UserTicketsMechanics
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
