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

        $dadosInduzidas = HelperTxPrenhezNovilhas::getDadosInduzidas($idProtInduzidas);
        $dadosNaoInduzidas = HelperTxPrenhezNovilhas::getDadosNaoInduzidas($idProtNaoInduzidas);

        $arr = [];

        $arr[] = $dadosInduzidas;
        $arr[] = $dadosNaoInduzidas;

        return json_encode($arr);
    }

    private static function getDadosInduzidas($idProtInduzidas)
    {
        $protInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProtInduzidas);

        $totalNovilhasNoProtInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Animal')
            ->findTotalNovilhasNoProtocolo($protInduzidas);

        $numNovilhasRepetiuNoProtInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasRepetiuNoProtocolo($protInduzidas);

        $numNovilhasPrenhasNoProtInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasPrenhasNoProtocolo($protInduzidas);

        $txDePrenhezNovilhasInduzidas = ($numNovilhasPrenhasNoProtInduzidas * 100) / $totalNovilhasNoProtInduzidas;

        return self::dadosToJson($protInduzidas, $totalNovilhasNoProtInduzidas, $numNovilhasRepetiuNoProtInduzidas,
        $numNovilhasPrenhasNoProtInduzidas, $txDePrenhezNovilhasInduzidas);
    }

    private static function getDadosNaoInduzidas($idProtNaoInduzidas)
    {
        $protNaoInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->find($idProtNaoInduzidas);

        $totalNovilhasNoProtNaoInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Animal')
            ->findTotalNovilhasNoProtocolo($protNaoInduzidas);

        $numNovilhasRepetiuNoProtNaoInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasRepetiuNoProtocolo($protNaoInduzidas);

        $numNovilhasPrenhasNoProtNaoInduzidas = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\IA')
            ->findNumNovilhasPrenhasNoProtocolo($protNaoInduzidas);

        $txDePrenhezNovilhasNaoInduzidas = ($numNovilhasPrenhasNoProtNaoInduzidas * 100) / $totalNovilhasNoProtNaoInduzidas;

        return self::dadosToJson($protNaoInduzidas, $totalNovilhasNoProtNaoInduzidas, $numNovilhasRepetiuNoProtNaoInduzidas,
            $numNovilhasPrenhasNoProtNaoInduzidas, $txDePrenhezNovilhasNaoInduzidas);
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