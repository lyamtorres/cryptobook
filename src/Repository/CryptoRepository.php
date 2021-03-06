<?php

namespace App\Repository;

use App\Entity\Crypto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Crypto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Crypto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Crypto[]    findAll()
 * @method Crypto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CryptoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Crypto::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Crypto $entity, bool $flush = true): void
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
    public function remove(Crypto $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function findMultipleByFields($nom, $symbole, $categorie, $createur)
    {
        $result = $this->createQueryBuilder('c');

        if ($nom != null) {
            $result
                ->andWhere('c.nom = :nom')
                ->setParameter('nom', $nom);
        }

        if ($symbole != null) {
            $result
                ->andWhere('c.symbole = :symbole')
                ->setParameter('symbole', $symbole);
        }

        if ($categorie != null) {
            $result
                ->andWhere('c.categorie = :categorie')
                ->setParameter('categorie', $categorie);
        }

        if ($createur != null) {
            $result
                ->andWhere('c.createur = :createur')
                ->setParameter('createur', $createur);
        }

        return $result->getQuery()->getResult();
    }

    // /**
    //  * @return Crypto[] Returns an array of Crypto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Crypto
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
