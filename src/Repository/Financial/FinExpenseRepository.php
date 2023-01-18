<?php

namespace App\Repository\Financial;

use App\Entity\Financial\FinExpense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinExpense>
 *
 * @method FinExpense|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinExpense|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinExpense[]    findAll()
 * @method FinExpense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinExpense::class);
    }

    public function save(FinExpense $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FinExpense $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
