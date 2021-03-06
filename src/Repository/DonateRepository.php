<?php

namespace App\Repository;

use App\Entity\DonateOLD;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DonateOLD|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonateOLD|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonateOLD[]    findAll()
 * @method DonateOLD[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonateOLD::class);
    }

    // /**
    //  * @return Donate[] Returns an array of Donate objects
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
    public function findOneBySomeField($value): ?Donate
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
