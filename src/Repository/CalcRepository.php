<?php

namespace App\Repository;

use App\Entity\Calc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Calc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calc[]    findAll()
 * @method Calc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalcRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Calc::class);
    }

    // /**
    //  * @return Calc[] Returns an array of Calc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Calc
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
