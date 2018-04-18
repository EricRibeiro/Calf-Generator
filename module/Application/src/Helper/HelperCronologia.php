<?php
/**
 * Created by IntelliJ IDEA.
 * User: ericribeiro
 * Date: 17/04/18
 * Time: 15:26
 */

namespace Application\Helper;


use Application\Entity\Cronologia;

class HelperCronologia
{

    public static function criarCronologia($entityManager, $animal, $classificacaoID)
    {
        $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacaoID);

        if (!is_null($animal->getId())) self::atualizarCronologiaAnterior($entityManager, $animal, $classificacaoID);

        $entityManager->persist($cronologia);
    }

    private static function criarCronologiaAnimal($entityManager, $animal, $classificacaoID)
    {
        $classificacao = $entityManager->getRepository('Application\Entity\Classificacao')->find($classificacaoID);
        $estado = self::getEstadoID($entityManager, $classificacaoID);
        $estacao = null;

        if (!is_null($animal->getCronologias())) {
            $ultimaCronologia = $animal->getUltimaCronologia();
            $estacao = $ultimaCronologia->getEstacao();

            if (!is_null($estacao)) {
                $dataFinalEstacao = $estacao->getDataFinal();
                $hoje = new \DateTime();
                $estacao = ($hoje > $dataFinalEstacao) ? null : $estacao;
            }
        }

        $cronologia = new Cronologia($animal, null, $estacao, $classificacao, $estado, null, new \DateTime());

        return $cronologia;
    }

    private static function atualizarCronologiaAnterior($entityManager, $animal, $classificacaoID)
    {
        $estadoFinal = self::getEstadoID($entityManager, $classificacaoID);
        $cronologiaAnterior = $animal->getUltimaCronologia();
        $cronologiaAnterior->setEstadoFinal($estadoFinal);
        $entityManager->persist($cronologiaAnterior);
    }

    private static function getEstadoID($entityManager, $classificacaoID)
    {
        $estadoID = -1;

        switch ($classificacaoID) {
            case '1':
                $estadoID = 1;
                break;
            case '2':
            case '4':
                $estadoID = 5;
                break;
            case '3':
            case '5':
                $estadoID = 4;
                break;
        }

        return $entityManager->find('Application\Entity\Estado', $estadoID);
    }
}