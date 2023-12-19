<?php

namespace App\Repository;

use App\Entity\Yeti;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * @extends ServiceEntityRepository<Yeti>
 *
 * @method Yeti|null find($id, $lockMode = null, $lockVersion = null)
 * @method Yeti|null findOneBy(array $criteria, array $orderBy = null)
 * @method Yeti[]    findAll()
 * @method Yeti[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YetiRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Yeti::class);
    }


    public function retrieveAllYetties()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;

    }


    public function retrieveByRating(int $limit)
    {
        return $this->createQueryBuilder('y')
            ->orderBy('y.rating', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }


    public function retrieveRandomRecord()
    {

        $numRecords = $this->createQueryBuilder('y')
            ->select('count(y.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;

        $offset = rand(0, $numRecords - 1);

        return $this->createQueryBuilder('y')
            ->setMaxResults(1)
            ->setFirstResult($offset)
            ->getQuery()
            ->getSingleResult()
        ;
    }

//    /**
//     * @return Yeti[] Returns an array of Yeti objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('y.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Yeti
//    {
//        return $this->createQueryBuilder('y')
//            ->andWhere('y.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
