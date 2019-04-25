<?php

namespace App\Repository;

use App\Entity\Car;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Car|null find($id, $lockMode = null, $lockVersion = null)
 * @method Car|null findOneBy(array $criteria, array $orderBy = null)
 * @method Car[]    findAll()
 * @method Car[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Car::class);
    }

    // /**
    //  * @return Car[] Returns an array of Car objects
    //  */
    
    public function searchCar($data)
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.cities','city')
            ->andWhere('city.name = :name')
            ->setParameter('name',$data['city']->getName())

            ->andWhere('c.color = :color')
            ->setParameter('color', $data['color'])
            ->andWhere('c.fuel = :carburant')
            ->setParameter('carburant',$data['fuel'] )
            ->andWhere('c.price > :min_price')
            ->setParameter('min_price',$data['min_price'] )
            ->andWhere('c.price < :max_price')
            ->setParameter('max_price',$data['max_price'])
            ->getQuery()
            ->getResult()
        ;
    }

    

    /*
    public function findOneBySomeField($value): ?Car
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
