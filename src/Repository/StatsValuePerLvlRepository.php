<?php

namespace App\Repository;

use App\Entity\StatsValuePerLvl;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method StatsValuePerLvl|null find($id, $lockMode = null, $lockVersion = null)
 * @method StatsValuePerLvl|null findOneBy(array $criteria, array $orderBy = null)
 * @method StatsValuePerLvl[]    findAll()
 * @method StatsValuePerLvl[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatsValuePerLvlRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StatsValuePerLvl::class);
    }

    // /**
    //  * @return StatsValuePerLvl[] Returns an array of StatsValuePerLvl objects
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
    public function findOneBySomeField($value): ?StatsValuePerLvl
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
