<?php

namespace App\Repository\Financial;

use App\Entity\Financial\FinBank;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinBank>
 *
 * @method FinBank|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinBank|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinBank[]    findAll()
 * @method FinBank[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinBankRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinBank::class);
    }

    public function save(FinBank $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FinBank $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getYearOnActiveBank(): array
    {
        return $this->createQueryBuilder('f')
            ->where('f.active = :active')
            ->setParameter('active', true)
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }

}
