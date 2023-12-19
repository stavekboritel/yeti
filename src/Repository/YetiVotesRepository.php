<?php

namespace App\Repository;

use App\Entity\YetiVotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<YetiVotes>
 *
 * @method YetiVotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method YetiVotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method YetiVotes[]    findAll()
 * @method YetiVotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class YetiVotesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YetiVotes::class);
    }


    public function getCalculatedRating(int $yeti_id)
    {
        return $this->createQueryBuilder('yv')
            ->select('SUM(yv.vote)')
            ->where('yv.yeti = :yeti_id')
            ->setParameter('yeti_id', $yeti_id)
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }


    public function retrieveStatsByDay(int $yeti_id)
    {
        $conn = $this->_em->getConnection();

        $sql = '
            SELECT DATE(created_at) as day, count(id) as count,  SUM(vote) as rating
            FROM  yeti_votes
            WHERE yeti_id = :yeti_id
            GROUP BY DATE(created_at)
            ';

        $resultSet = $conn->executeQuery($sql, ['yeti_id' => $yeti_id]);

        return $resultSet->fetchAllAssociative();
    }

}
