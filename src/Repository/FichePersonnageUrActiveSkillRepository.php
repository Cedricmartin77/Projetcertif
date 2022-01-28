<?php

namespace App\Repository;

use App\Entity\FichePersonnageUrActiveSkill;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FichePersonnageUrActiveSkill|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePersonnageUrActiveSkill|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePersonnageUrActiveSkill[]    findAll()
 * @method FichePersonnageUrActiveSkill[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePersonnageUrActiveSkillRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePersonnageUrActiveSkill::class);
    }

    // /**
    //  * @return FichePersonnageUrActiveSkill[] Returns an array of FichePersonnageUrActiveSkill objects
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
    public function findOneBySomeField($value): ?FichePersonnageUrActiveSkill
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
