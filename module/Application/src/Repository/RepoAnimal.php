<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 20/04/18
 * Time: 16:28
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoAnimal extends EntityRepository
{
    public function findAllAnimaisNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->innerJoin('Application\Entity\IA', 'ia', 'WITH', 'ia = c.ia')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'p = ia.protocolo')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial != :apto')
            ->andWhere('p = :protocolo')
            ->setParameter('apto', 1)
            ->setParameter('protocolo', $protocolo)
            ->getQuery()
            ->execute();
    }

    public function findAnimaisPorEstadoNaUltimaEstacao($estado, $estacao)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial = :estado')
            ->andWhere('c.estacao = :estacao')
            ->setParameter('estado', $estado)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->execute();
    }

    public function findAllAnimaisNaEstacao($estacao)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estacao = :estacao')
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->execute();
    }

    public function findAllAnimaisAptosOuPosPartoComMinimoDeDiasNaUltimaEstacao($estacao, $minimoDeDias)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial = :apto OR (c.estadoInicial = :posParto AND DATE_DIFF(CURRENT_DATE(), animal.dataUltimoParto) >= :minimoDeDias)')
            ->andWhere('c.estacao = :estacao')
            ->setParameter('apto', 1)
            ->setParameter('posParto', 5)
            ->setParameter('minimoDeDias', $minimoDeDias)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->getResult();
    }

    public function findAllAnimaisAptosOuPosPartoSemEstacao()
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->leftJoin('Application\Entity\Estacao', 'e', 'WITH', 'e = c.estacao')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial = :apto OR c.estadoInicial = :posParto')
            ->andWhere('c.estacao IS NULL OR DATE_DIFF(e.dataFinal, CURRENT_DATE()) < 0')
            ->setParameter('apto', 1)
            ->setParameter('posParto', 5)
            ->getQuery()
            ->getResult();
    }
}