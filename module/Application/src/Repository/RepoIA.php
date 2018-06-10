<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 20/04/18
 * Time: 16:28
 */

namespace Application\Repository;

use Application\Helper\HelperEntityManager;
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

//    public function findNumNovilhasRepetiuNoProtocolo($protocolo)
//    {
//        $qb = $this->createQueryBuilder('ia');
//        $qb2 = HelperEntityManager::$entityManager->createQueryBuilder();
//
//        return $qb->select('count(ia.animal)')
//            ->where(
//                $qb->expr()->in(
//                    'ia.animal',
//                    $qb2->select('ia2.animal')
//                        ->from('Application\Entity\IA', 'ia2')
//                        ->where('ia2.protocolo = :protocolo')
//                        ->setParameter('protocolo', $protocolo)
//                        ->getDQL()
//                )
//            )
//            ->andWhere('ia.protocolo < :protocolo')
//            ->andWhere('ia.saiuProtocolo = :saiuProtocolo')
//            ->setParameter('protocolo', $protocolo)
//            ->setParameter('saiuProtocolo', 1)
//            ->getQuery()
//            ->getSingleScalarResult();
//
//    }
}