<?php

namespace App\Repository;

use App\Entity\InfractionsIG;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InfractionsIG>
 *
 * @method InfractionsIG|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfractionsIG|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfractionsIG[]    findAll()
 * @method InfractionsIG[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfractionsIGRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfractionsIG::class);
    }

    public function save(InfractionsIG $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(InfractionsIG $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return InfractionsIG[] Returns an array of InfractionsIG objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?InfractionsIG
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
