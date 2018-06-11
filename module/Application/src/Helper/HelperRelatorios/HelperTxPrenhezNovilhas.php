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

        $dadosInduzidas = HelperTxPrenhezNovilhas::getDados($idProtInduzidas);
        $dadosNaoInduzidas = HelperTxPrenhezNovilhas::getDados($idProtNaoInduzidas);

        $arr = [];

        $arr[] = $dadosInduzidas;
        $arr[] = $dadosNaoInduzidas;

        return json_encode($arr);
    }

    private static function getDados($idProt)
    {
        $protocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProt);

        $totalNovilhasNoProtocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findTotalNovilhasNoProtocolo($protocolo);

        $numNovilhasRepetiuNoProtocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasRepetiuNoProtocolo($protocolo);

        $numNovilhasPrenhasNoProtocolo = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasPrenhasNoProtocolo($protocolo);

        $txDePrenhezNovilhas = ($numNovilhasPrenhasNoProtocolo * 100) / $totalNovilhasNoProtocolo;

        return self::dadosToJson($protocolo, $totalNovilhasNoProtocolo, $numNovilhasRepetiuNoProtocolo,
        $numNovilhasPrenhasNoProtocolo, $txDePrenhezNovilhas);
    }

    private static function dadosToJson($prot, $totalNovilhas, $numNovilhasRepetiu, $numNovilhasPrenhas, $txPrenhez)
    {
        $arr = array(
            'NumProt' => $prot->getNumero(),
            'TotalNovilhasNoProt' => $totalNovilhas,
            'NumNovilhasRepetiuNoProt' => $numNovilhasRepetiu,
            'NumNovilhasPrenhasNoProt' => $numNovilhasPrenhas,
            'TxPrenhez' => $txPrenhez
        );

        return json_encode($arr);
    }
}