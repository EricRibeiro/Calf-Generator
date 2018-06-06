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

    public function findAllNovilhasParaInducaoNaEstacao($estacao)
    {           
           return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->innerJoin('Application\Entity\Animal_Classificacao', 'acl', 'WITH', 'acl.animal = animal')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('acl.classificacaoInicial = :classificacao')
            ->andWhere('c.estacao = :estacao')
            ->andWhere('c.ia IS NULL')
            ->setParameter('classificacao', 1)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->getResult();
    }

    public function findAllAnimaisParaProtocoloComMinimoDeDiasNaUltimaEstacao($estacao, $minimoDeDias)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Parto', 'p1', 'WITH', 'animal = p1.animal')
            ->leftJoin('Application\Entity\Parto', 'p2', 'WITH', 'animal = p2.id AND (p1.parto < p2.parto OR p1.parto = p2.parto AND p1.id < p2.id)')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->leftJoin('Application\Entity\Inducao', 'i', 'WITH', 'animal.inducao = i')
            ->where('p2.id IS NULL')
            ->andwhere('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial = :apto OR (c.estadoInicial = :posParto AND DATE_DIFF(CURRENT_DATE(), p1.parto) >= :minimoDeDias)')
            ->andWhere('c.estacao = :estacao')
            ->orWhere('DATE_DIFF(CURRENT_DATE(), i.dataFinal) >= :minimoInducao')
            ->setParameter('apto', 1)
            ->setParameter('minimoInducao', 12)
            ->setParameter('posParto', 5)
            ->setParameter('minimoDeDias', $minimoDeDias)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->getResult();
    }

    public function findAllAnimaisForaDaEstacao()
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->leftJoin('Application\Entity\Estacao', 'e', 'WITH', 'e = c.estacao')
            ->where('c.estadoFinal IS NULL')
            ->andWhere('c.estadoInicial = :apto OR c.estadoInicial = :posParto OR c.estadoInicial = :aguardandoInducao')
            ->andWhere('c.estacao IS NULL OR DATE_DIFF(e.dataFinal, CURRENT_DATE()) < 0')
            ->setParameter('apto', 1)
            ->setParameter('aguardandoInducao', 6)
            ->setParameter('posParto', 5)
            ->getQuery()
            ->getResult();
    }
}