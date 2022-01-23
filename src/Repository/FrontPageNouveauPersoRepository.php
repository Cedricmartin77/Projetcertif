<?php

namespace App\Repository;

use App\Entity\FrontPageNouveauPerso;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FrontPageNouveauPerso|null find($id, $lockMode = null, $lockVersion = null)
 * @method FrontPageNouveauPerso|null findOneBy(array $criteria, array $orderBy = null)
 * @method FrontPageNouveauPerso[]    findAll()
 * @method FrontPageNouveauPerso[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrontPageNouveauPersoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FrontPageNouveauPerso::class);
    }

    // /**
    //  * @return FrontPageNouveauPerso[] Returns an array of FrontPageNouveauPerso objects
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
    public function findOneBySomeField($value): ?FrontPageNouveauPerso
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
