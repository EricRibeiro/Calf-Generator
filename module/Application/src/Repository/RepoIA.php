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
        return $this->createQueryBuilder('ia1')
            ->innerJoin('Application\Entity\IA', 'ia2', 'WITH', 'ia1.animal = ia2.animal')
            ->where('ia1.id > ia2.id')
            ->andWhere('ia1.saiuProtocolo = :saiuProtocolo')
            ->setParameter('saiuProtocolo', 1)
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