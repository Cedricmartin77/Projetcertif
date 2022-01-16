<?php

namespace App\Repository;

use App\Entity\FichePersonnageSsr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePersonnageSsr|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePersonnageSsr|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePersonnageSsr[]    findAll()
 * @method FichePersonnageSsr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePersonnageSsrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePersonnageSsr::class);
    }

    // /**
    //  * @return FichePersonnageSsr[] Returns an array of FichePersonnageSsr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FichePersonnageSsr
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
