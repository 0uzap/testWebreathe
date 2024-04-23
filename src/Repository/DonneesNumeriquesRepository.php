<?php

namespace App\Repository;

use App\Entity\DonneesNumeriques;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DonneesNumeriques>
 *
 * @method DonneesNumeriques|null find($id, $lockMode = null, $lockVersion = null)
 * @method DonneesNumeriques|null findOneBy(array $criteria, array $orderBy = null)
 * @method DonneesNumeriques[]    findAll()
 * @method DonneesNumeriques[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DonneesNumeriquesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DonneesNumeriques::class);
    }

    //    /**
    //     * @return DonneesNumeriques[] Returns an array of DonneesNumeriques objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DonneesNumeriques
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
