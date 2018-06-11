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
            ->where('p = :protocolo')
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

    public function findAllAnimaisNaInducao($inducao)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Inducao', 'i', 'WITH', 'i = animal.inducao')
            ->where('i.id = :inducao')
            ->setParameter('inducao', $inducao)
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
            ->andWhere(' c.estadoInicial = :aguardando ') 
            ->setParameter('classificacao', 1)
            ->setParameter('estacao', $estacao)
            ->setParameter('aguardando', 6)
            ->getQuery()
            ->getResult();
    }

    public function findAllAnimaisParaProtocoloComMinimoDeDiasNaUltimaEstacao($estacao, $minimoDeDias)
    {
        return $this->createQueryBuilder('animal')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->innerJoin('Application\Entity\Parto', 'p1', 'WITH', 'animal = p1.animal')
            ->leftJoin('Application\Entity\Parto', 'p2', 'WITH', 'animal = p2.id AND 
                (p1.parto < p2.parto OR p1.parto = p2.parto AND p1.id < p2.id)')
            ->leftJoin('Application\Entity\Inducao', 'i', 'WITH', 'animal.inducao = i')
            ->where('p2.id IS NULL')
            ->andWhere('c.estacao = :estacao')
            ->andWhere('c.estadoFinal IS NULL')
            ->andWhere(' c.estadoInicial = :apto 
                    OR (c.estadoInicial = :posParto AND (DATE_DIFF(CURRENT_DATE(), p1.parto) >= :minimoDeDias))
                    OR (c.estadoInicial = :aguardando)
                    OR (c.estadoInicial = :posInducao AND (DATE_DIFF(CURRENT_DATE(), i.dataFinal) >= :minimoInducao)
                )
            ')
            ->setParameter('apto', 1)
            ->setParameter('posParto', 5)
            ->setParameter('aguardando', 6)
            ->setParameter('posInducao', 7)
            ->setParameter('minimoInducao', 12)
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

    public function findTotalNovilhasNoProtocolo($protocolo)
    {
        return $this->createQueryBuilder('animal')
            ->select('count(animal.id)')
            ->innerJoin('Application\Entity\IA', 'ia', 'WITH', 'animal = ia.animal')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'ia.protocolo = p')
            ->innerJoin('Application\Entity\Cronologia', 'c1', 'WITH', 'animal = c1.animal')
            ->leftJoin('Application\Entity\Cronologia', 'c2', 'WITH', 'animal = c2.animal AND c1.id < c2.id')
            ->where('p = :protocolo')
            ->andWhere('c2.id IS NULL')
            ->andWhere('c1.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }

}