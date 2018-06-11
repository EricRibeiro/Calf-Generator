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
    public static function getDadosTxPrenhezProtocolo($idEstacao, $idProtInduzidas, $idProtNaoInduzidas)
    {
        $dadosInduzidas = self::getDados($idProtInduzidas);
        $dadosNaoInduzidas = self::getDados($idProtNaoInduzidas);

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

        $totalVacasNoProtocolo = self::findTotalVacasNoProtocolo($protocolo);

        $numVacasRepetiuNoProtocolo = self::findNumVacasRepetiuNoProtocolo($protocolo);

        $numVacasPrenhasNoProtocolo = self::findNumVacasPrenhasNoProtocolo($protocolo);

        $txDePrenhezVacas = ($numVacasPrenhasNoProtocolo * 100) / $totalVacasNoProtocolo;
        $txDePrenhezVacas = number_format($txDePrenhezVacas, 2, ',', '.');

        return self::dadosToJson($protocolo, $totalVacasNoProtocolo, $numVacasRepetiuNoProtocolo,
            $numVacasPrenhasNoProtocolo, $txDePrenhezVacas);
    }

    private static function findTotalVacasNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(distinct ia.animal)')
            ->from('Application\Entity\IA', 'ia')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'ia.protocolo = p')
            ->where('p = :protocolo')
            ->setParameter('protocolo', $protocolo)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private static function findNumVacasRepetiuNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(distinct ia1.animal)')
            ->from('Application\Entity\IA', 'ia1')
            ->innerJoin('Application\Entity\IA', 'ia2', 'WITH', 'ia1.animal = ia2.animal AND ia1.estacao = ia2.estacao')
            ->where('ia2.protocolo = :protocolo')
            ->andWhere('ia1.protocolo < :protocolo')
            ->setParameter('protocolo', $protocolo)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private static function findNumVacasPrenhasNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(ia.animal)')
            ->from('Application\Entity\IA', 'ia')
            ->innerJoin('Application\Entity\Cronologia', 'c1', 'WITH', 'ia = c1.ia')
            ->leftJoin('Application\Entity\Cronologia', 'c2', 'WITH', 'ia = c2.ia AND c1.id < c2.id')
            ->where('ia.protocolo = :protocolo')
            ->andWhere('c2.id IS NULL')
            ->andWhere('((c1.estadoInicial = :gestante AND c1.estadoFinal IS NULL) OR (c1.estadoInicial = :ag2 AND c1.estadoFinal = :gestante))')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('ag2', 3)
            ->setParameter('gestante', 4)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private static function dadosToJson($prot, $totalVacas, $numVacasRepetiu, $numVacasPrenhas, $txPrenhez)
    {
        $arr = array(
            'NumProt' => $prot->getNumero(),
            'TotalVacasNoProt' => $totalVacas,
            'NumVacasRepetiuNoProt' => $numVacasRepetiu,
            'NumVacasPrenhasNoProt' => $numVacasPrenhas,
            'TxPrenhez' => $txPrenhez
        );

        return json_encode($arr);
    }
}