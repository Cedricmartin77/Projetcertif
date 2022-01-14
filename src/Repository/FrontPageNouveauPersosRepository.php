<?php

namespace App\Repository;

use App\Entity\FrontPageNouveauPersos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FrontPageNouveauPersos|null find($id, $lockMode = null, $lockVersion = null)
 * @method FrontPageNouveauPersos|null findOneBy(array $criteria, array $orderBy = null)
 * @method FrontPageNouveauPersos[]    findAll()
 * @method FrontPageNouveauPersos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrontPageNouveauPersosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FrontPageNouveauPersos::class);
    }

    // /**
    //  * @return FrontPageNouveauPersos[] Returns an array of FrontPageNouveauPersos objects
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
    public function findOneBySomeField($value): ?FrontPageNouveauPersos
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
