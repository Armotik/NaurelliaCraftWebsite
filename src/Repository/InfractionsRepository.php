<?php

namespace App\Repository;

use App\Entity\Infractions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Infractions>
 *
 * @method Infractions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Infractions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Infractions[]    findAll()
 * @method Infractions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfractionsRepository extends ServiceEntityRepository
{

    /**
     * InfractionsRepository constructor.
     * @param ManagerRegistry $registry The registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infractions::class);
    }

    /**
     * @param Infractions $entity The entity
     * @param bool $flush Whether to flush or not
     */
    public function save(Infractions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Infractions $entity The entity
     * @param bool $flush Whether to flush or not
     */
    public function remove(Infractions $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Infractions[] Returns an array of Infractions objects
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

//    public function findOneBySomeField($value): ?Infractions
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
