<?php

namespace App\Repository\Financial;

use App\Entity\Financial\FinBilan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinBilan>
 *
 * @method FinBilan|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinBilan|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinBilan[]    findAll()
 * @method FinBilan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinBilanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinBilan::class);
    }

    public function save(FinBilan $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FinBilan $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function setAllActiveFalse()
    {
        return $this->createQueryBuilder('f')
                ->update()
                ->set('f.active', ':value')
                ->setParameter('value', false)
                ->getQuery()
                ->execute()
        ;
    }

    public function getActive()
    {
        return $this->createQueryBuilder('f')
            ->where('f.active = :active')
            ->setParameter('active', true)
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }
}
