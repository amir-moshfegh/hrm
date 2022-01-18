<?php

namespace App\Repository;

use App\Entity\History;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method History|null find($id, $lockMode = null, $lockVersion = null)
 * @method History|null findOneBy(array $criteria, array $orderBy = null)
 * @method History[]    findAll()
 * @method History[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, History::class);
    }

    /**
     * @return History[] Returns an array of History objects
     */
    public function getAllHistoryByUser($user)
    {
        return $this->createQueryBuilder('h')
            ->join('h.user', 'u')
            ->join('h.base', 'b')
            ->join('b.category', 'c')
            ->join('u.person', 'p')
            ->addSelect('u')
            ->addSelect('b')
            ->addSelect('c')
            ->addSelect('p')
            ->andWhere('h.user = :val')
            ->setParameter('val', $user)
            ->orderBy('b.category', 'ASC')
            ->addOrderBy('h.noticeDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?History
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
