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
}