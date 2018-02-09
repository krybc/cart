<?php

declare(strict_types=1);

namespace App\Component\Order\Repository;

use App\Component\Order\Model\OrderInterface;
use Doctrine\ORM\EntityRepository;

class OrderRepository extends EntityRepository
{
    public function findOneById($id): ?OrderInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getOneOrNullResult()
            ;
    }
}