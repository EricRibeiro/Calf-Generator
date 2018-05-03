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
            ->innerJoin('Application\Entity\IA', 'ia', 'WITH', 'ia.animal = animal')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'p = ia.protocolo')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'c.animal = animal')
            ->innerJoin('Application\Entity\Estado', 'e', 'WITH', 'e = c.estadoInicial')
            ->where('c.estadoFinal IS NULL AND c.estadoInicial <> :apto')
            ->andWhere('p = :protocolo')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('apto', 1)
            ->getQuery()
            ->execute();
    }
}