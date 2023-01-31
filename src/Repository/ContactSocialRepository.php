<?php

namespace App\Repository;

use Doctrine\ORM\QueryBuilder;
use App\Entity\Site\ContactSocial;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<ContactSocial>
 *
 * @method ContactSocial|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactSocial|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactSocial[]    findAll()
 * @method ContactSocial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactSocialRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactSocial::class);
    }

    public function save(ContactSocial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ContactSocial $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getPublishedQuery(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('c')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
        ;
        return $qb;
    }

    public function getEnabledContact()
    {
        return $this->getPublishedQuery()
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getSocialMediaLinks()
    {
        return $this->getPublishedQuery()
            ->select('c.facebook, c.instagram, c.youtube')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
    public function setAllDisabled(): void
    {
        $this->createQueryBuilder('c')
            ->update()
            ->set('c.enabled', 'false')
            ->getQuery()
            ->execute();
    }
}
