<?php

namespace App\Repository;

use App\Entity\Sex;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sex>
 *
 * @method Sex|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sex|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sex[]    findAll()
 * @method Sex[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SexRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sex::class);
    }

}

