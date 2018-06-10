<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 10/06/18
 * Time: 16:13
 */

namespace Application\Helper\HelperRelatorios;

use Application\Helper\HelperEntityManager;

class HelperRelatorio
{
    public static function getJsonProtocolosDaEstacao($idEstacao)
    {
        $estacao = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Estacao')
            ->find($idEstacao);

        $protocolos = HelperEntityManager::$entityManager
            ->getRepository('Application\Entity\Protocolo')
            ->findBy(array('estacao' => $estacao));

        $jsonProtocolos = [];

        foreach ($protocolos as $p) {
            $jsonProtocolos[] = json_encode($p);
        }

        return json_encode($jsonProtocolos);
    }
}