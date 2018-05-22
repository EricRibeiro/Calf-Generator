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

    public function findUltimaIA($animal)
    {

    	return $this->createQueryBuilder('ia')
    		->where("ia.animal = :animal")
    		->setParameter("animal", $animal)
            ->orderBy("ia.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

    }
}