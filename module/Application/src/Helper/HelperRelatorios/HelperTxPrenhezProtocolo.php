<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 10/06/18
 * Time: 15:59
 */

namespace Application\Helper\HelperRelatorios;


use Application\Helper\HelperEntityManager;

class HelperTxPrenhezProtocolo
{
    public static function getDadosTxPrenhezProtocolosAction($idEstacao)
    {
        $protocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProtInduzidas);

        $animais = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Animal')
            ->findAllAnimaisNoProtocolo($protocolo);

//        $numNovilhasRepetiuNoProtocolo = HelperEntityManager::$entityManager
//            ->getRepository('Application\Entity\IA')
//            ->findNumNovilhasRepetiuNoProtocolo($protocolo);

        return $totalNovilhasNoProtocolo;
    }
}