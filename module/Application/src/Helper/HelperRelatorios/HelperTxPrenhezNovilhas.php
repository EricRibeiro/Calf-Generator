<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 10/06/18
 * Time: 15:59
 */

namespace Application\Helper\HelperRelatorios;


use Application\Helper\HelperEntityManager;

class HelperTxPrenhezNovilhas
{
    public static function getDadosTxPrenhezNovilhasAction($idEstacao, $idProtInduzidas, $idProtNaoInduzidas)
    {
        $protocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProtInduzidas);

        $totalNovilhasNoProtocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Animal')
            ->findTotalNovilhasNoProtocolo($protocolo);

//        $numNovilhasRepetiuNoProtocolo = HelperEntityManager::$entityManager
//            ->getRepository('Application\Entity\IA')
//            ->findNumNovilhasRepetiuNoProtocolo($protocolo);

        return $totalNovilhasNoProtocolo;
    }
}