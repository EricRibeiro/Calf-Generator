<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 22/04/18
 * Time: 18:18
 */

namespace Application\Helper;

use Doctrine\ORM\EntityRepository;

class HelperInducao
{   

    public static function getDiasDaInducao($animal)
    {
        $inducao = HelperEntityManager::$entityManager
                    ->getRepository("Application\Entity\Inducao")
                    ->createQueryBuilder('ind')
                    ->innerJoin('Application\Entity\Animal', 'a')
                    ->where("a = :animal")
                    ->andWhere("ind = a.inducao")
                    ->setParameter("animal", $animal)
                    ->getQuery()
                    ->getOneOrNullResult();
      
        $dataInicio  = $inducao->getDataInicio();
        $hoje = new \DateTime();
        $dDiff = $dataInicio->diff($hoje);
        $dDiff->format('%R%A');      
        return $dDiff->days;
    }

    public static function getDiasDaInducaoPorInducao($inducao)
    {
        $dataInicio  = $inducao->getDataInicio();
        $hoje = new \DateTime();
        $dDiff = $dataInicio->diff($hoje);
        $dDiff->format('%R%A');      
        return $dDiff->days;
    }
}