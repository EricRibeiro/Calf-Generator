<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 20/04/18
 * Time: 16:28
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoIA extends EntityRepository
{
    public function findAllIAs()
    {
        return $this->createQueryBuilder('ia')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.ia = ia')
            ->where('c.estadoFinal IS NULL')
            ->getQuery()
            ->execute();
    }
}