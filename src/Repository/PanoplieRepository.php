<?php

namespace App\Repository;

use App\Entity\Panoplie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Panoplie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panoplie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panoplie[]    findAll()
 * @method Panoplie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanoplieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panoplie::class);
    }

    // /**
    //  * @return Panoplie[] Returns an array of Panoplie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Panoplie
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
