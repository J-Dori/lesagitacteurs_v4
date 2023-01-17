<?php

namespace App\Repository;

use App\Entity\Site\PlayGallery;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PlayGallery>
 *
 * @method PlayGallery|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlayGallery|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlayGallery[]    findAll()
 * @method PlayGallery[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlayGalleryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayGallery::class);
    }

    public function save(PlayGallery $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PlayGallery $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getGalleryByPositionOrder($play, $order = 'ASC'): array
   {
       return $this->createQueryBuilder('pg')
            ->andWhere('pg.play = :val')
            ->setParameter('val', $play)
            ->orderBy('pg.position', $order)
            ->getQuery()
            ->getResult()
        ;
   }

   public function getLastPosition($play): array
   {
       return $this->createQueryBuilder('pg')
            ->select('pg.position')
            ->andWhere('pg.play = :val')
            ->setParameter('val', $play)
            ->orderBy('pg.position', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
   }

}
