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
    public static function getDadosTxPrenhezNovilhas($idEstacao, $idProtInduzidas, $idProtNaoInduzidas)
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

        $totalNovilhasNoProtocolo = self::findTotalNovilhasNoProtocolo($protocolo);

        $numNovilhasRepetiuNoProtocolo = self::findNumNovilhasRepetiuNoProtocolo($protocolo);

        $numNovilhasPrenhasNoProtocolo = self::findNumNovilhasPrenhasNoProtocolo($protocolo);

        $txDePrenhezNovilhas = ($numNovilhasPrenhasNoProtocolo * 100) / $totalNovilhasNoProtocolo;
        $txDePrenhezNovilhas = number_format($txDePrenhezNovilhas, 2, ',', '.');

        return self::dadosToJson($protocolo, $totalNovilhasNoProtocolo, $numNovilhasRepetiuNoProtocolo,
        $numNovilhasPrenhasNoProtocolo, $txDePrenhezNovilhas);
    }

    private static function findTotalNovilhasNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(distinct ia.animal)')
            ->from('Application\Entity\IA', 'ia')
            ->innerJoin('Application\Entity\Protocolo', 'p', 'WITH', 'ia.protocolo = p')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'ia.animal = c.animal')
            ->where('p = :protocolo')
            ->andWhere('c.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private static function findNumNovilhasRepetiuNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(distinct ia1.animal)')
            ->from('Application\Entity\IA', 'ia1')
            ->innerJoin('Application\Entity\IA', 'ia2', 'WITH', 'ia1.animal = ia2.animal AND ia1.estacao = ia2.estacao')
            ->innerJoin('Application\Entity\Cronologia', 'c', 'WITH', 'ia1 = c.ia')
            ->where('ia2.protocolo = :protocolo')
            ->andWhere('ia1.protocolo < :protocolo')
            ->andWhere('c.classificacao = :novilha')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    private static function findNumNovilhasPrenhasNoProtocolo($protocolo)
    {
        $qb = HelperEntityManager::$entityManager->createQueryBuilder();

        return $qb->select('count(ia.animal)')
            ->from('Application\Entity\IA', 'ia')
            ->innerJoin('Application\Entity\Cronologia', 'c1', 'WITH', 'ia = c1.ia')
            ->leftJoin('Application\Entity\Cronologia', 'c2', 'WITH', 'ia = c2.ia AND c1.id < c2.id')
            ->where('ia.protocolo = :protocolo')
            ->andWhere('c2.id IS NULL')
            ->andWhere('c1.classificacao = :novilha')
            ->andWhere('((c1.estadoInicial = :gestante AND c1.estadoFinal IS NULL) OR (c1.estadoInicial = :ag2 AND c1.estadoFinal = :gestante))')
            ->setParameter('protocolo', $protocolo)
            ->setParameter('novilha', 1)
            ->setParameter('ag2', 3)
            ->setParameter('gestante', 4)
            ->getQuery()
            ->getSingleScalarResult();
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