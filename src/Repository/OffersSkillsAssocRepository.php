<?php

namespace App\Repository;

use App\Entity\OffersSkillsAssoc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OffersSkillsAssoc>
 *
 * @method OffersSkillsAssoc|null find($id, $lockMode = null, $lockVersion = null)
 * @method OffersSkillsAssoc|null findOneBy(array $criteria, array $orderBy = null)
 * @method OffersSkillsAssoc[]    findAll()
 * @method OffersSkillsAssoc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OffersSkillsAssocRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OffersSkillsAssoc::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(OffersSkillsAssoc $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(OffersSkillsAssoc $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return OffersSkillsAssoc[] Returns an array of OffersSkillsAssoc objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OffersSkillsAssoc
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
