<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 20/04/18
 * Time: 16:28
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoAnimalClassificacao extends EntityRepository
{
    public function findAllAnimaisNaEstacao($estacao)
    {
        return $this->createQueryBuilder('ac')
            ->where('ac.classificacaoFinal IS NULL')
            ->andWhere('ac.estacao = :idEstacao')
            ->setParameter('idEstacao', $estacao)
            ->groupBy('ac.animal')
            ->getQuery()
            ->execute();
    }
}