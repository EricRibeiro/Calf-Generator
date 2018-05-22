<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/05/18
 * Time: 13:32
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoCronologia extends EntityRepository
{
    public function findUltimaCronologia($animal)
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('Application\Entity\Animal', 'a', 'WITH', 'c.animal = :animal')
            ->where('c.estadoFinal IS NULL')
            ->setParameter('animal', $animal)
            ->getQuery()
            ->execute();
    }
}