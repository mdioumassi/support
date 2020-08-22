<?php

namespace App\Repository;

use App\Entity\DoDonate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DoDonate|null find($id, $lockMode = null, $lockVersion = null)
 * @method DoDonate|null findOneBy(array $criteria, array $orderBy = null)
 * @method DoDonate[]    findAll()
 * @method DoDonate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoDonateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoDonate::class);
    }

    // /**
    //  * @return DoDonate[] Returns an array of DoDonate objects
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
    public function findOneBySomeField($value): ?DoDonate
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
