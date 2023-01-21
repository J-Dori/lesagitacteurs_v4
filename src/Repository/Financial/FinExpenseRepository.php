<?php

namespace App\Repository\Financial;

use App\Entity\Financial\FinExpense;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\Financial\FinBilanRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

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
    public function __construct(ManagerRegistry $registry, private FinBilanRepository $finBilanRepository)
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

    public function getBilanActive()
    {
        $bilan = $this->finBilanRepository->getActive();

        $q = $this->createQueryBuilder('f');
        if (!empty($bilan)) {
            $q->where('f.finBilan = :bilan');
            $q->setParameter('bilan', $bilan);
        }
        return $q;
    }

    public function getListByBilanActive($fullQuery = true)
    {
        $q = $this->getBilanActive();
        $q->orderBy('f.date', 'DESC');

        if ($fullQuery) {
            return $q->getQuery()->getResult();
        }

        return $q;
    }

    public function getTotalSumByYearSession()
    {
        $q = $this->getListByBilanActive(false);
        $q->select('SUM(f.amount) AS total');
        $result = $q->getQuery()->getSingleColumnResult();
        
        return $result[0];
    }

}
