<?php

namespace App\Repository;

use App\Entity\Site\ContactSocial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

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

    public function getSocialMediaLinks()
    {
        return $this->createQueryBuilder('c')
            ->select('c.facebook, c.instagram, c.youtube')
            ->where('c.enabled = :enabled')
            ->setParameter('enabled', true)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();
    }
}
