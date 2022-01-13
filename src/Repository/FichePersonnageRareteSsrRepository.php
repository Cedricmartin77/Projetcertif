<?php

namespace App\Repository;

use App\Entity\FichePersonnageRareteSsr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePersonnageRareteSsr|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePersonnageRareteSsr|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePersonnageRareteSsr[]    findAll()
 * @method FichePersonnageRareteSsr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePersonnageRareteSsrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePersonnageRareteSsr::class);
    }

    // /**
    //  * @return FichePersonnageRareteSsr[] Returns an array of FichePersonnageRareteSsr objects
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
    public function findOneBySomeField($value): ?FichePersonnageRareteSsr
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
