<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 18:18
 */

namespace Application\Helper;


class HelperIA
{   

    public static function getUltimaIA($animal,$protocolo)
    {
        return HelperEntityManager::$entityManager->getRepository("Application\Entity\IA")
            ->createQueryBuilder('ia')
            ->where("ia.animal = :animal")
            ->andWhere("ia.protocolo = :protocolo")
            ->setParameter("animal", $animal)
            ->setParameter("protocolo", $protocolo)
            ->orderBy("ia.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}