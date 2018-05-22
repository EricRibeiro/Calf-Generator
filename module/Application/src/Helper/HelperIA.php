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

    public static function getUltimaIA($animal)
    {   
        $serviceManager = $sm;
        $entityManager = $serviceManager->get('Doctrine\ORM\EntityManager');
        self::$entityManager->getRepository("Application\Entity\IA")
            ->createQueryBuilder('ia')
            ->where("ia.animal = :animal")
            ->setParameter("animal", $animal)
            ->orderBy("ia.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}