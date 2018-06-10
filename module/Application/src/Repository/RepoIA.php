<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 20/04/18
 * Time: 16:28
 */

namespace Application\Repository;

use Application\Helper\HelperEntityManager;
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

    public function findNumNovilhasRepetiuNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('ia1')
            ->select('count(distinct ia1.animal)')
            ->innerJoin('Application\Entity\IA', 'ia2', 'WITH', 'ia1.animal = ia2.animal')
            ->innerJoin('Application\Entity\Cronologia', 'c1', 'WITH', 'ia1 = c1.ia')
            ->leftJoin('Application\Entity\Cronologia', 'c2', 'WITH', 'ia1 = c2.ia AND c1.id < c2.id')
            ->where('ia2.protocolo = :protocolo')
            ->andWhere('ia1.protocolo < :protocolo')
            ->andWhere('ia1.saiuProtocolo = :saiuProtocolo')
            ->andWhere('c2.id IS NULL')
            ->andWhere('c1.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('saiuProtocolo', 1)
            ->setParameter('novilha', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findNumNovilhasPrenhasNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('ia')
            ->select('count(ia.animal)')
            ->innerJoin('Application\Entity\Cronologia', 'c1', 'WITH', 'ia = c1.ia')
            ->leftJoin('Application\Entity\Cronologia', 'c2', 'WITH', 'ia = c2.ia AND c1.id < c2.id')
            ->where('ia.protocolo = :protocolo')
            ->andWhere('ia.saiuProtocolo = :saiuProtocolo')
            ->andWhere('c2.id IS NULL')
            ->andWhere('c1.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('saiuProtocolo', 0)
            ->setParameter('novilha', 1)
            ->distinct()
            ->getQuery()
            ->getSingleScalarResult();
    }
}