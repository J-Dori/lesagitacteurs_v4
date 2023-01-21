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

    public function getCurrentBalance(): ?float
    {
        $q = $this->createQueryBuilder('f')
            ->select('f.balance')
            ->where('f.active = :active')
            ->setParameter('active', true)
            ->getQuery()
            ->getOneOrNullResult();
        ;

        if (empty($q)) { return 0; }

        return $q['balance'];
    }

    public function updateBalance(float $value)
    {
        return $this->createQueryBuilder('f')
                ->update()
                ->set('f.balance', ':value')
                ->setParameter('value', $value)
                ->where('f.active = :active')
                ->setParameter('active', true)
                ->getQuery()
                ->execute()
        ;
    }

}
