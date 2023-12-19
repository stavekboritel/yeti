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


    /**
     * Retrieve all Yetties ordered from latest
     *
     * @return array
     */
    public function retrieveAllYetties()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;

    }


    /**
     * Retrieve all records ordered by rating
     *
     * @param int limit
     *
     * @return array
     */
    public function retrieveByRating(int $limit)
    {
        return $this->createQueryBuilder('y')
            ->orderBy('y.rating', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * Retrieve random record
     *
     * @return \App\Entity\Yeti
     */
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

}

