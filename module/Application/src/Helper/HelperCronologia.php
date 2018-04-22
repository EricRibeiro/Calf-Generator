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
    /**
     * @param EntityManager $args[0]
     * @param Animal $args[1]
     * @param Classificacao $args[2]
     * @param Estacao $args[3] - Opcional
     */
    public static function criarCronologia(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estacao = $args[3];
        $cronologia = null;

        if ($qtdArgumentos == 3) {
            $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacao);
        }

        if ($qtdArgumentos == 4) {
            $cronologia = self::criarCronologiaAnimal($entityManager, $animal, $classificacao, $estacao);
        }

        if (!is_null($animal->getId())) self::atualizarCronologiaAnterior($entityManager, $animal, $classificacao);

        $entityManager->persist($cronologia);
    }

    private static function criarCronologiaAnimal(...$args)
    {
        $qtdArgumentos = count($args);

        $entityManager = $args[0];
        $animal = $args[1];
        $classificacao = $args[2];
        $estacao = $args[3];
        $ia = null;
        $cronologia = null;
        $estado = self::getEstadoID($entityManager, $classificacao);

        if ($qtdArgumentos == 3) {
            $cronologia = new Cronologia($animal, $ia, null, $classificacao, $estado, null, new \DateTime());
        }

        if ($qtdArgumentos == 4) {
            if (is_null($estacao)) {
                $estacao = self::getEstacao($animal);
            }

            $cronologia = new Cronologia($animal, $ia, $estacao, $classificacao, $estado, null, new \DateTime());
        }

        return $cronologia;
    }

    private static function atualizarCronologiaAnterior($entityManager, $animal, $classificacao)
    {
        $estadoFinal = self::getEstadoID($entityManager, $classificacao);
        $cronologiaAnterior = $animal->getUltimaCronologia();
        $cronologiaAnterior->setEstadoFinal($estadoFinal);
        $entityManager->persist($cronologiaAnterior);
    }

    private static function getEstadoID($entityManager, $classificacao)
    {
        $estadoID = -1;

        switch ($classificacao->getId()) {
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

    private static function getEstacao($animal)
    {
        $estacao = null;

        if (sizeof($animal->getCronologias()) > 0) {
            $ultimaCronologia = $animal->getUltimaCronologia();
            $estacao = $ultimaCronologia->getEstacao();

            if (!is_null($estacao)) {
                $dataFinalEstacao = $estacao->getDataFinal();
                $hoje = new \DateTime();
                $estacao = ($hoje > $dataFinalEstacao) ? null : $estacao;
            }
        }

        return $estacao;
    }

    private static function getIA($animal)
    {
        $ia = null;

        if (sizeof($animal->getIAs()) > 0) {
            $ultimaIA = $animal->getUltimaIA();
            $dataDiagnostico2 = $ultimaIA->getDataDiagnostico2();
            $hoje = new \DateTime();
            $ia = ($hoje > $dataDiagnostico2) ? null : $ia;
        }

        return $ia;
    }
}