<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 16:12
 */

namespace Application\Repository;

use Application\Helper\HelperEstacao;
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

    public function findAnimaisAptosOuPosPartoNaUltimaEstacao($estacao) {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :apto OR cronologia.estadoInicial = :posParto')
            ->andWhere('cronologia.estacao = :estacao')
            ->setParameter('apto', 1)
            ->setParameter('posParto', 5)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->getResult();
    }

    public function findAnimaisPorEstadoNaUltimaEstacao($estado, $estacao) {
        return $this->createQueryBuilder('cronologia')
            ->where('cronologia.estadoFinal IS NULL')
            ->andWhere('cronologia.estadoInicial = :estado')
            ->andWhere('cronologia.estacao = :estacao')
            ->setParameter('estado', $estado)
            ->setParameter('estacao', $estacao)
            ->getQuery()
            ->getResult();
    }
}