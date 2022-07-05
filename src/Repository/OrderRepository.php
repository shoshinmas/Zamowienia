<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Ramsey\Uuid\UuidInterface;

/**
 * @extends ServiceEntityRepository<Order>
 *
 * @method Order|null find($id, $lockMode = null, $lockVersion = null)
 * @method Order|null findOneBy(array $criteria, array $orderBy = null)
 * @method Order[]    findAll()
 * @method Order[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function remove(Order $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return Order[] Returns an array of Order objects
     */
    public function findByEmail(string $clientEmail): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.clientEmail = :clientEmail')
            ->setParameter('clientEmail', $clientEmail)
            ->orderBy('o.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByUuid(UuidInterface $uuid): ?Order
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.uuid = :uuid')
            ->setParameter('uuid', $uuid)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    public function save(Order $order, bool $flush = true): void
    {
        $this->getEntityManager()->persist($order);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}
