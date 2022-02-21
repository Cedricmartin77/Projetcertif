<?php

namespace App\Repository;

use App\Entity\EncyclopedieDuPersonnage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EncyclopedieDuPersonnage|null find($id, $lockMode = null, $lockVersion = null)
 * @method EncyclopedieDuPersonnage|null findOneBy(array $criteria, array $orderBy = null)
 * @method EncyclopedieDuPersonnage[]    findAll()
 * @method EncyclopedieDuPersonnage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EncyclopedieDuPersonnageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EncyclopedieDuPersonnage::class);
    }

    public function findEncyclopedieDuPersonnages($encyclopedieDesPersonnageId)
    {
        return $this->createQueryBuilder('e')
            ->select('e', 'f')
            ->leftJoin('e.fichePersonnages', 'f')
            ->andWhere('e.encyclopedieDesPersonnages = :edpId')
            ->setParameter('edpId', $encyclopedieDesPersonnageId)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return EncyclopedieDuPersonnage[] Returns an array of EncyclopedieDuPersonnage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EncyclopedieDuPersonnage
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
