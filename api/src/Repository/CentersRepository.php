<?php

namespace App\Repository;

use App\Entity\Centers;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Uid\Uuid;

/**
 * @method Centers|null find($id, $lockMode = null, $lockVersion = null)
 * @method Centers|null findOneBy(array $criteria, array $orderBy = null)
 * @method Centers[]    findAll()
 * @method Centers[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CentersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Centers::class);
    }

}
