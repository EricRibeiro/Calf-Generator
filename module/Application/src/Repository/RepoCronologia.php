<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 16:12
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoCronologia extends EntityRepository
{
    public function findAnimaisAptosOuPosParto() {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :apto OR cronologia.estadoInicial = :posParto')
            ->setParameter('apto', 1)
            ->setParameter('posParto', 5)
            ->getQuery()
            ->getResult();
    }

    public function findAnimaisAptos() {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :apto')
            ->setParameter('apto', 1)
            ->getQuery()
            ->getResult();
    }

    public function findAnimaisDiagnostico1() {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :diagnostico1')
            ->setParameter('diagnostico1', 2)
            ->getQuery()
            ->getResult();
    }

    public function findAnimaisDiagnostico2() {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :diagnostico2')
            ->setParameter('diagnostico2', 3)
            ->getQuery()
            ->getResult();
    }

    public function findAnimaisPosParto() {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :posparto')
            ->setParameter('posparto', 5)
            ->getQuery()
            ->getResult();
    }
}