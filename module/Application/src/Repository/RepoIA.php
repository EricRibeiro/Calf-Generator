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

    public function findTotalNovilhasNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('ia')
            ->select('count(distinct ia.animal)')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'ia.protocolo = p')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'ia.animal = c.animal')
            ->where('p = :protocolo')
            ->andWhere('c.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function findNumNovilhasRepetiuNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('ia1')
            ->select('count(distinct ia1.animal)')
            ->innerJoin('Application\Entity\IA', 'ia2', 'WITH', 'ia1.animal = ia2.animal AND ia1.estacao = ia2.estacao')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'ia1 = c.ia')
            ->where('ia2.protocolo = :protocolo')
            ->andWhere('ia1.protocolo < :protocolo')
            ->andWhere('c.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
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
            ->andWhere('c2.id IS NULL')
            ->andWhere('c1.classificacao = :novilha')
            ->andWhere('((c1.estadoInicial = :gestante AND c1.estadoFinal IS NULL) OR (c1.estadoInicial = :ag2 AND c1.estadoFinal = :gestante))')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->setParameter('ag2', 3)
            ->setParameter('gestante', 4)
            ->getQuery()
            ->getSingleScalarResult();
    }
}