<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 16:12
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoEstacao extends EntityRepository
{
    public function findUltimaEstacao() {
        return $this->createQueryBuilder('estacao')
            ->orderBy("estacao.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}