<?php

namespace App\Repository;

use App\Entity\RaspberryPi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RaspberryPi>
 *
 * @method RaspberryPi|null find($id, $lockMode = null, $lockVersion = null)
 * @method RaspberryPi|null findOneBy(array $criteria, array $orderBy = null)
 * @method RaspberryPi[]    findAll()
 * @method RaspberryPi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RaspberryPiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RaspberryPi::class);
    }

    public function add(RaspberryPi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RaspberryPi $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RaspberryPi[] Returns an array of RaspberryPi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?RaspberryPi
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
