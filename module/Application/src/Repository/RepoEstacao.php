<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 16:12
 */

namespace Application\Repository;

use Doctrine\ORM\EntityRepository;

class RepoEstacao extends EntityRepository
{
    /**
     * @return \Application\Entity\Estacao | Null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findUltimaEstacaoNoAno()  {

        return $this->createQueryBuilder('e')
            ->where('DATE_DIFF(CURRENT_DATE(), e.dataFinal) <= 0')
            ->orderBy("e.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}