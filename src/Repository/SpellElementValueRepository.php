<?php

namespace App\Repository;

use App\Entity\SpellElementValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SpellElementValue|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpellElementValue|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpellElementValue[]    findAll()
 * @method SpellElementValue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpellElementValueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SpellElementValue::class);
    }

    // /**
    //  * @return SpellElementValue[] Returns an array of SpellElementValue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SpellElementValue
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
