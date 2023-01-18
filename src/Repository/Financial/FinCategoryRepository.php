<?php

namespace App\Repository\Financial;

use App\Entity\Financial\FinCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinCategory>
 *
 * @method FinCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinCategory[]    findAll()
 * @method FinCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinCategory::class);
    }

    public function save(FinCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FinCategory $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getAllOrderByName(): array
    {
        return $this->createQueryBuilder('f')
            ->orderBy('f.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
}
