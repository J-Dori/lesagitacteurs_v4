<?php

namespace App\Repository;

use App\Entity\Site\Play;
use App\Trait\PlayStatusEnum;
use App\Trait\ObjectStateEnum;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Play>
 *
 * @method Play|null find($id, $lockMode = null, $lockVersion = null)
 * @method Play|null findOneBy(array $criteria, array $orderBy = null)
 * @method Play[]    findAll()
 * @method Play[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Play::class);
    }

    public function getPublishedQuery(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.state = :state')
            ->setParameter('state', ObjectStateEnum::ENABLED)
        ;
        return $qb;
    }

    public function getAllPublishedOrderBy(string $order = 'ASC')
    {
        return $this->getPublishedQuery()
            ->orderBy('p.year', $order)
            ->getQuery()
            ->getResult()
        ;
    }

    public function getPlayStatusUpFront()
    {
        return $this->getPublishedQuery()
            ->andWhere('p.playStatus = :upFront')
            ->setParameter('upFront', PlayStatusEnum::UPFRONT)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function getLastPlay()
    {
        return $this->getPublishedQuery()
                ->addOrderBy('p.id', 'DESC')
                ->setMaxResults(1)
                ->getQuery()
                ->getResult()
        ;
    }

    public function setAllStatusToClose()
    {
        return $this->createQueryBuilder('p')
                ->update()
                ->set('p.playStatus', ':value')
                ->setParameter('value', PlayStatusEnum::CLOSED)
                ->getQuery()
                ->execute()
        ;
    }

}
