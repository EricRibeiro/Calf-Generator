<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 18/04/18
 * Time: 10:59
 */

namespace Application\Helper;


class HelperQuery
{
    /**
     * Repository method for finding the newest inserted
     * entry inside the database. Will return the latest
     * entry when one is existent, otherwise will return
     * null.
     *
     * @return MyTable|null
     */
    public static function getUltimaInsercao($repositorio)
    {
        return $repositorio
            ->createQueryBuilder("e")
            ->orderBy("e.id", "DESC")
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}