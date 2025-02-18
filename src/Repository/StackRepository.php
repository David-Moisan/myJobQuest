<?php

namespace App\Repository;

use App\Entity\Stack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Stack|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stack|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stack[]    findAll()
 * @method Stack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stack::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Stack $entity, bool $flush = true): void
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
    public function remove(Stack $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * Method findMyFavorite
     * @return object
     */
    public function findMyFavorite()
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.isFavorite = 1')
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Stack[] Returns an array of Stack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Stack
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
